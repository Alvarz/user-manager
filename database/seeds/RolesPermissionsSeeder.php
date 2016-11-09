<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = DB::table('permissions')->get();
        $role = DB::table('roles')->where('slug', '=', 'admin.super')->get();

        foreach ($permissions as $key => $value) {
            DB::table('permission_role')->insert(
                [
                'role_id' => $role[0]->id,
                'permission_id' => $value->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
