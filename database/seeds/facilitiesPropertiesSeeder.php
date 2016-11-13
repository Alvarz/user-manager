<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class facilitiesPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=1; $i < 51; $i++) {
        for ($j=1; $j < 6; $j++) {

          DB::table('properties_facilities')->insert(
              [
              'property_id' => $i,
              'facility_id' => $j,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
              ]
          );
        }
      }


    }
}
