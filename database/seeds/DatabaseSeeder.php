<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RolesPermissionsSeeder::class);
        $this->call(RolesUserSeeder::class);
        $this->call(facilitiesTableSeeder::class);
        $this->call(stateTableSeeder::class);
        $this->call(propertiesSeeder::class);

    }
}
