<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class stateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $arrayFacilities = ['Edificio con ascensor','Piscina','Estacionamiento', 'Cocina', 'Aire acondicionado', 'Calefacción'];

      foreach ($arrayFacilities as $facilitie) {
        DB::table('facilities')->insert(
            [
            'name' => $facilitie,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );
      }

    }
}
