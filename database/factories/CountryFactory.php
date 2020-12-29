<?php

/** @var Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Address;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Country::class, function (Faker $faker) {
    /**
     * @var Faker|Address $faker
     */
    $faker->addProvider(new Address($faker));
    return [
        'name' => $faker->country,
        'acronym' => $faker->countryCode
    ];
});
