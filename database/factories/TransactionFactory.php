<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'value' => $faker->randomFloat(2,-100, 100),
        'description' => $faker->text(255),
        'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
    ];
});
