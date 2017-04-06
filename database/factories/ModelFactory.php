<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'cpf' => $faker->numerify('###########'),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'last_access' => Carbon\Carbon::now()->format('Y-m-d H:i:s'), 
        'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
    ];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'cpf' => $faker->numerify('###########'),
        'name' => $faker->name,
        'course' => $faker->jobTitle,
        'institution' => $faker->company
    ];
});

$factory->define(App\Email::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->email
    ];
});

$factory->define(App\Telephone::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'phone' => $faker->tollFreePhoneNumber
    ];
});