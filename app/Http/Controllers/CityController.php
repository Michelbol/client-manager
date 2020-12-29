<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Services\CityService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CityController extends Controller
{

    /**
     * @var CityService
     */
    private $service;

    public function __construct(CityService $service)
    {
        $this->service = $service;
    }

    /**
     * @param State $state
     * @return City[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
     */
    public function getCityByState(State $state)
    {
        return $this->service->getCitiesByStateOrderByName($state);
    }
}
