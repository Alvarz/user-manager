<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class facilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $arrayStates = ['En revisión','Activo','Inactivo'];

      foreach ($arrayStates as $stateName) {
        DB::table('states')->insert(
            [
            'name' => $stateName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );
      }
    }
}
