<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*PERMISSIONS*/

        DB::table('permissions')->insert(
            [
            'name' => 'Add permission',
            'slug' => 'permission.add',
            'description' => 'Add permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'edit permission',
            'slug' => 'permission.edit',
            'description' => 'edit permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'list permission',
            'slug' => 'permission.list',
            'description' => 'list permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'delete permission',
            'slug' => 'permission.delete',
            'description' => 'delete permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'assign permission',
            'slug' => 'permission.assign',
            'description' => 'assign permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'revoke permission',
            'slug' => 'permission.revoke',
            'description' => 'revoke permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

          /*ROLES*/

        DB::table('permissions')->insert(
            [
            'name' => 'Add roles',
            'slug' => 'role.add',
            'description' => 'Add roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'edit roles',
            'slug' => 'role.edit',
            'description' => 'edit roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'delete roles',
            'slug' => 'role.delete',
            'description' => 'delete roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'assign roles',
            'slug' => 'role.assign',
            'description' => 'assign roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'revoke roles',
            'slug' => 'role.revoke',
            'description' => 'revoke roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'list roles',
            'slug' => 'role.list',
            'description' => 'list roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

          /*USERS*/

        DB::table('permissions')->insert(
            [
            'name' => 'Add users',
            'slug' => 'user.add',
            'description' => 'Add users',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'edit users',
            'slug' => 'user.edit',
            'description' => 'edit users',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'delete users',
            'slug' => 'user.delete',
            'description' => 'delete users',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'list users',
            'slug' => 'user.list',
            'description' => 'list users',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

          /*APPS*/

        DB::table('permissions')->insert(
            [
            'name' => 'add apps',
            'slug' => 'app.add',
            'description' => 'add apps',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'edit apps',
            'slug' => 'app.edit',
            'description' => 'edit apps',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'delete apps',
            'slug' => 'app.delete',
            'description' => 'delete apps',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'list apps',
            'slug' => 'app.list',
            'description' => 'list apps',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

          /*DEPOSITS*/

        DB::table('permissions')->insert(
            [
            'name' => 'add deposits',
            'slug' => 'deposits.add',
            'description' => 'add deposits',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'edit deposits',
            'slug' => 'deposits.edit',
            'description' => 'edit deposits',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'list of deposits',
            'slug' => 'deposits.list',
            'description' => 'list of deposits',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'delete deposits',
            'slug' => 'deposits.delete',
            'description' => 'delete deposits',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

          /*WITHDRAWALS*/

        DB::table('permissions')->insert(
            [
            'name' => 'add withdrawals',
            'slug' => 'withdrawals.add',
            'description' => 'add withdrawals',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'edit withdrawals',
            'slug' => 'withdrawals.edit',
            'description' => 'edit withdrawals',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'list of withdrawals',
            'slug' => 'withdrawals.list',
            'description' => 'list of withdrawals',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );

        DB::table('permissions')->insert(
            [
            'name' => 'delete withdrawals',
            'slug' => 'withdrawals.delete',
            'description' => 'delete withdrawals',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        );
    }
}
