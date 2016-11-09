<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = DB::table('roles')->where('slug', '=', 'admin.super')->get();
        $user = DB::table('users')->where('name', '=', 'admin')->get();

        $_role = DB::table('roles')->where('slug', '=', 'admin.default')->get();
        $_user = DB::table('users')->where('name', '=', 'administrator')->get();

            DB::table('role_user')->insert(
                [
                'role_id' => $role[0]->id,
                'user_id' => $user[0]->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );

            DB::table('role_user')->insert(
                [
                'role_id' => $_role[0]->id,
                'user_id' => $_user[0]->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );


    }
}
