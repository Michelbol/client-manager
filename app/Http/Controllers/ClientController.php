<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientIndexRequest;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Services\ClientService;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * @var ClientService
     */
    private $clientService;

    /**
     * ClientController constructor.
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ClientIndexRequest $request
     * @return Application|Factory|Response|View
     */
    public function index(ClientIndexRequest $request)
    {
        $data = $request->validated();
        $search = null;
        if(isset($data['search'])){
            $search = $data['search'];
        }
        return view(
            'clients.index',
            [
                'clients' => $this
                    ->clientService
                    ->findClientsPaginateWithCityOrderByName($search),
                'search' => $search
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientStoreRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ClientStoreRequest $request)
    {
        DB::beginTransaction();
        $this->clientService->create($request->validated());
        DB::commit();
        $this->successMessage('Cliente Savo com Sucesso');
        return redirect()->route('clients.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Application|Factory|Response|View
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientUpdateRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $this->clientService->update($client, $request->validated());
        $this->successMessage('Cliente Savo com Sucesso');
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Application|RedirectResponse|Response|Redirector|string
     */
    public function destroy(Client $client)
    {
        try {
            $this->clientService->delete($client);
            $this->successMessage('Cliente Deletado com Sucesso');
        }catch (Exception $exception){
            $this->errorMessage('Erro ao deletar cliente:'. $exception->getMessage());
        }
        return redirect()->route('clients.index');
    }
}
