<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
  
    public function run(): void
    {

           app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'manage users']);


           
        $admin = Role::create(['name'=>'admin']);
        $editor = Role::create(['name'=>'editor']);
        $author = Role::create(['name'=> 'author']);
        $user =     Role::create(['name'=>'user']);

        $admin->givePermissionTo([permission::all()]);

        $editor->givePermissionTo(['edit articles', 'publish articles']);
        $author->givePermissionTo(['create articles', 'edit articles']);





    }
}
