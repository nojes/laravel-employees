<?php

use Faker\Generator as Faker;
use nojes\employee\Models\Employee;
use nojes\employee\Models\Position;

$factory->define(Employee::class, function (Faker $faker) {
    $employees = Employee::all();

    return [
        'name' => $faker->name,
        'salary' => $faker->numberBetween(500, 10000),
        'hired_at' => $faker->dateTimeThisYear(),
        'head_id' => ($employees->isNotEmpty()) ? $employees->random()->id : NULL,
        'position_id' => Position::all()->random()->id
    ];
});
