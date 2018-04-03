<?php

use Faker\Generator as Faker;
use nojes\employees\Models\Employee;
use nojes\employees\Models\Position;

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

$factory->define(Employee::class, function (Faker $generator) {
    return [
        'name' => $generator->name,
        'salary' => $generator->numberBetween(500, 10000),
        'hired_at' => $generator->dateTimeThisYear(),
        'position_id' => Position::all()->random()->id,
        'photo' => $generator->imageUrl(400, 300, 'people')
    ];
});

$factory->state(Employee::class, 'randomParent', function (Faker $generator) {
    $employees = Employee::limit(50)->get(['id']);

    return [
        'name' => $generator->name,
        'salary' => $generator->numberBetween(500, 10000),
        'hired_at' => $generator->dateTimeThisYear(),
        'parent_id' => ($employees->isNotEmpty()) ? $employees->random()->id : NULL,
        'position_id' => Position::all()->random()->id,
        'photo' => $generator->imageUrl(400, 300, 'people')
    ];
});

$factory->state(Employee::class, 'localPhoto', function (Faker $generator) {
    $photoPath = 'public/employees/photos';
    $filePath = storage_path('app' . '/' . $photoPath);
    if(!File::exists($filePath)){
        File::makeDirectory($filePath, 0755, true);
    }

    return [
        'photo' => $photoPath . '/' . $generator->image($filePath, 400, 300, 'people', false)
    ];
});
