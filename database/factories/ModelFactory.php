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



$factory->define(
    App\User::class, function (Faker\Generator $faker) {
        return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        ];
    }
);

$factory->define(
    App\Apps::class, function (Faker\Generator $faker) {
        return [
        'name' => $faker->company,
        'api_token' => $faker->uuid,
        'client_id' => $faker->creditCardNumber,
        'url' => $faker->url
        ];
    }
);

// $factory->define(
//     App\Deposits::class, function (Faker\Generator $faker) {
//
//         $apps = DB::table('apps')->first();
//
//         print_r($apps);
//         echo $apps->client_id;
//         return [
//         'name' => $faker->name,
//         'email' => $faker->safeEmail,
//         'bank' => $faker->company,
//         'amount' => $faker->numberBetween($min = 50, $max = 100),
//         'transaction_type' => 'bank',
//         'voucher_img' => 'http://placehold.it/350x150',
//         'voucher_number' => $faker->creditCardNumber,
//         'origin_bank' => $faker->company,
//         'status' => 'waiting',
//         'IdPlayer' => 17299,
//         'client_id' => (int)$apps->client_id,
//         ];
//     }
// );
