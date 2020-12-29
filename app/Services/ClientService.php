<?php


namespace App\Services;


use App\Models\Client;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientService
{
    /**
     * @param null $search
     * @return LengthAwarePaginator
     */
    public function findClientsPaginateWithCityOrderByName($search = null): LengthAwarePaginator
    {
        $query = Client
//            ::with('city');
        ::join('cities as c', 'c.id', 'clients.city_id');
        if(isset($search)){
            $query
                ->orWhere('clients.name', 'like', "%$search%")
                ->orWhere('c.name', 'like', "%$search%");
            if(in_array($search, __('enums.gender'))){
                $query->orWhere('gender', array_search($search, __("enums.gender")));
            }
        }
        return $query
            ->orderBy('clients.name')
            ->select(
                'clients.name as name',
                'date_of_birth',
                'gender',
                'c.name as city_name',
                'clients.id'
            )
            ->paginate(10);
    }

    /**
     * @param Client $model
     * @param array $data
     */
    public function fill(Client $model, array $data)
    {
        $model->name = $data['name'];
        $model->date_of_birth = Carbon::createFromFormat('d/m/Y', $data['date_of_birth']);
        $model->gender = $data['gender'];
        $model->zip_code = isset($data['zip_code']) ? returnOnlyNumbers($data['zip_code']): null;
        $model->address = isset($data['address']) ? $data['address'] : null;
        $model->number = isset($data['number']) ? $data['number'] : null;
        $model->complement = isset($data['complement']) ? $data['complement'] : null;
        $model->neighborhood = isset($data['neighborhood']) ? $data['neighborhood'] : null;
        $model->city_id = isset($data['city_id']) ? $data['city_id'] : null;
    }

    /**
     * @param array $data
     * @return Client
     */
    public function create(array $data)
    {
        $model = new Client();
        $this->fill($model, $data);
        $model->save();
        return $model;
    }

    /**
     * @param Client $model
     * @param array $data
     * @return Client
     */
    public function update(Client $model, array $data)
    {
        $this->fill($model, $data);
        $model->save();
        return $model;
    }

    /**
     * @param Client $model
     * @throws Exception
     */
    public function delete(Client $model)
    {
        $model->delete();
    }
}
