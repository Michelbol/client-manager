<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(Country::class, 1000)->create();
        $this->createCountry('Brasil', 'BR');
    }

    public function createCountry(string $name, string $acronym)
    {
        if(!Country::whereName($name)->exists()){
            $country = new Country();
            $country->name = $name;
            $country->acronym = $acronym;
            $country->save();
        }
    }
}
