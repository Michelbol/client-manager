<?php

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(State::class, 1000)->create();
        $this->createStatesByFile();
    }

    public function createStatesByFile()
    {
        $statesArray = json_decode(
            file_get_contents(
                resource_path('/json/states.json')
            ),
            true
        );
        $country = Country::whereName("Brasil")->select('id')->first();

        foreach ($statesArray as $state) {
            if (!State::whereAcronym($state['uf'])->exists()) {
                $states[] = [
                    'id' => $state['id'],
                    'name' => $state['name'],
                    'acronym' => $state['uf'],
                    'country_id' => $country->id
                ];
            }
        }
        if(isset($states) && count($states) > 0){
            State::insert($states);
        }
    }
}
