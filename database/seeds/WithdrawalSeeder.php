<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $apps = DB::table('apps')->get();
        $total = count($apps) - 1;


        for ($i=0; $i < 50; $i++) {

            DB::table('withdrawals')->insert(
                [
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'destination_bank' => $faker->company,
                'account_number' => $faker->bankAccountNumber,
                'amount' => $faker->numberBetween($min = 50, $max = 100),
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
