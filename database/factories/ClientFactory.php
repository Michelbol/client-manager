<?php

/** @var Factory $factory */

use App\Enums\GenderEnum;
use App\Models\City;
use App\Models\Client;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Faker\Provider\pt_BR\Address;

$cities = City::pluck('id');

$factory->define(Client::class, function (Faker $faker) use ($cities) {
    /**
     * @var Faker|Address $faker
     */
    $faker->addProvider(new Address($faker));
    return [
        'name' => $faker->name,
        'date_of_birth' => $faker->dateTimeBetween('-30 years', 'now'),
        'gender' => $faker->randomElement(GenderEnum::getAllValues()),
        'zip_code' => $faker->postcode,
        'address' => $faker->streetAddress,
        'number' => $faker->buildingNumber,
        'complement' => $faker->secondaryAddress,
        'neighborhood' => $faker->city,
//        'city_id' => factory(City::class),
        'city_id' => $faker->randomElement($cities)
    ];
});
