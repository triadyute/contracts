<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['User', 'Editor', 'Admin', 'SuperUser']),
        'description' => $faker->sentence
    ];
});
$factory->state(Role::class, 'SUPERUSER', ['name' => 'SuperUser']);
$factory->state(Role::class, 'ADMIN', ['name' => 'Admin']);
$factory->state(Role::class, 'EDITOR', ['name' => 'Editor']);
$factory->state(Role::class, 'USER', ['name' => 'User']);