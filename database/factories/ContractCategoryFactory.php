<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\ContractCategory;

$factory->define(ContractCategory::class, function (Faker $faker) {
    return [
        'category' => $faker->unique()->randomElement(['Client', 'Facility Services', 'Finance', 'IT', 'Legal', 'Management', 'Marketing'])
    ];
});
