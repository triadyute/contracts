<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Contract;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        'company_id' => 3,
        'supplier' => $faker->company,
        'alert_date' => $faker->date('Y-m-d'),
        'primary_contact' => $faker->numberBetween($min = 2, $max = 3),
        'reference' => $faker->stateAbbr . $faker->ean8,//randomNumber($nbDigits = NULL, $strict = false),
        'add_to_calendar' => false,
        'category' => $faker->randomElement(['Client', 'Facility Services', 'Finance', 'Management', 'Legal']),
        'currency' => $faker->randomElement(['usd', 'gbp', 'eur']),
        'contract_value' => $faker->randomElement([600, 1000, 10000]),
        'contract_period' => $faker->randomElement(['per year', 'per month', 'per quarter']),
        'start_date' => $faker->date('Y-m-d'),
        'notice_period' => $faker->randomElement(['3 months', '6 months', '12 months']),
        'end_date' => $faker->date('Y-m-d'),
        'no_end_date' => false,
        'requires_special_privileges' => false,
        'created_by' => $faker->randomElement([2, 3]),
        'visible_to' => 'all users',
        'secondary_contact' => 3,
        'file' => NULL,
        'notes' => 'test',
        'link' => NULL,
        'google_link' => NULL,
    ];
});