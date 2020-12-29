<?php


namespace App\Services;


use App\Models\Client;
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
}
