<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ChangeLog::class, function (Faker $faker) {
    return [
        'contract_id' => $faker->unique()->numberBetween($min = 1, $max = 30),
        'changes' => 'Alert created',
        'changed_by' => $faker->randomElement([2, 3]),
    ];
});
