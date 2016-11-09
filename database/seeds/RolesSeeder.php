<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
            'name' => 'Super administrator',
            'slug' => 'admin.super',
            'description' => 'Super administrator, developers',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'special' => 1
            ]
        );

        DB::table('roles')->insert(
            [
            'name' => 'administrator',
            'slug' => 'admin.default',
            'description' => 'administrator of the site',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'special' => 0
            ]
        );

        DB::table('roles')->insert(
            [
            'name' => 'default',
            'slug' => 'default.default',
            'description' => 'administrator of the site',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'special' => 0
            ]
        );
    }
}
