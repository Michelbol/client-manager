<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(City::class, 1000)->create();
        $this->createCitiesByFile();
    }

    public function createCitiesByFile()
    {
        $citiesArray = json_decode(
            file_get_contents(
                resource_path('/json/cities.json')
            ),
            true
        );
        foreach ($citiesArray as $city) {
            if (!$this->cityExists($city['name'], $city['state_id'])) {
                $cities[] = [
                    'name' => $city['name'],
                    'ibge_code' => $city['code'],
                    'state_id' => $city['state_id']
                ];
            }
        }
        if(isset($cities) && count($cities) > 0){
            City::insert($cities);
        }
    }

    /**
     * @param string $name
     * @param string $stateId
     * @return bool
     */
    public function cityExists(string $name, string $stateId): bool
    {
        return City
            ::whereName($name)
            ->whereStateId($stateId)
            ->exists();
    }
}
