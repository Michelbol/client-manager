<?php


namespace App\Services;


use App\Models\City;
use App\Models\State;
use Cache;

class CityService
{
    public function getCitiesByStateOrderByName(State $state)
    {
        return Cache::remember("city-$state->id", now()->addWeek(), function() use($state){
            return City
                ::whereStateId($state->id)
                ->orderBy('name')
                ->get();
        });
    }
}
