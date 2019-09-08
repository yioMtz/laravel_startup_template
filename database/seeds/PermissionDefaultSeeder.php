<?php

use Illuminate\Database\Seeder;

class PermissionDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'create-role',
            'guard_name' => 'web',
            'description' => 'User is allowed to create new roles'
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'create-permissions',
            'guard_name' => 'web',
            'description' => 'The user is allowed to create permissions'
        ]);
        DB::table('permissions')->insert([
            'name' => 'assign-permissions-to-user',
            'guard_name' => 'web',
            'description' => 'User is allowed to assign permissions directly to a user'
        ]);
        DB::table('permissions')->insert([
            'name' => 'assign-permissions-to-role',
            'guard_name' => 'web',
            'description' => 'User is allowed to assign one or many permission to a role'
        ]);

    }
}
