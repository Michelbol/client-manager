<?php

/** @var Factory $factory */

use App\Models\Country;
use App\Models\State;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Address;
use Illuminate\Database\Eloquent\Factory;

$country = Country::pluck('id');
$factory->define(State::class, function (Faker $faker) use ($country) {
    /**
     * @var Faker|Address $faker
     */
    $faker->addProvider(new Address($faker));
    return [
        'name' => $faker->state(),
        'acronym' => $faker->stateAbbr(),
//        'country_id' => factory(Country::class)
        'country_id' => $faker->randomElement($country)
    ];
});
