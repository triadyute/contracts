<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Company::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'sector' => $faker->randomElement(['Healthcare','Marketing']),
        'number_of_employees' => $faker->randomElement(['1 - 10','11 - 50']),
        'created_by' => 3
    ];
});
