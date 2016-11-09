<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DepositsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Deposits::class, 50)->create();

        $faker = Faker\Factory::create();

        $apps = DB::table('apps')->get();
        $total = count($apps) - 1;


        for ($i=0; $i < 50; $i++) {

            DB::table('deposits')->insert(
                [
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'bank' => $faker->company,
                'amount' => $faker->numberBetween($min = 50, $max = 100),
                'transaction_type' => 'bank',
                'voucher_img' => 'http://placehold.it/350x150',
                'voucher_number' => $faker->creditCardNumber,
                'origin_bank' => $faker->company,
                'status' => 'waiting',
                'IdPlayer' => 17299,
                'client_id' => $apps[$faker->numberBetween(0, $total)]->client_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );
        }

    }
}
