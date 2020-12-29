<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientIndexRequest;
use App\Http\Requests\ClientStoreRequest;
use App\Services\ClientService;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
