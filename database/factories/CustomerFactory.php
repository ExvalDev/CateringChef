<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'postcode' => $faker->numberBetween($min = 10000, $max = 99999),
        'place' => $faker->city,
        'street' => $faker->streetName,
        'house_number' => $faker->buildingNumber,
        'adults' => $faker->numberBetween($min = 50, $max = 200),
        'childrens' => $faker->numberBetween($min = 50, $max = 200),
    ]; 
});
