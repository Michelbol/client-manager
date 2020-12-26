<?php

/** @var Factory $factory */

use App\Models\City;
use App\Models\State;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Address;
use Illuminate\Database\Eloquent\Factory;

$states = State::pluck('id');
$factory->define(City::class, function (Faker $faker) use($states) {
    /**
     * @var Faker|Address $faker
     */
    $faker->addProvider(new Address($faker));
    return [
        'name' => $faker->city,
        'ibge_code' => $faker->randomNumber(7),
//        'state_id' => factory(State::class),
        'state_id' => $faker->randomElement($states)
    ];
});
