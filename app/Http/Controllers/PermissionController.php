<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function store(Request $reuqest){


        $reuqest->validate([
           'name' => 'required|unique:permissions,name',
        ]);


        Permission::create(['name'=>$reuqest->name]);

        return response()->json(['message'=>'permission created succesfuly']);



    }

    public function assignToRole(Request $reuqest){

        $reuqest->validate([

               'role' => 'required|exists:roles,name',
        'permission' => 'required|exists:permissions,name',

        ]);

        $role = Role::findByName($reuqest->role);

        $role->givePermissionTo($reuqest->permission);


        return response()->json(['message' => 'permission succesfully given to this role' ]);



    }

   public function assignToUser(Request $request, User $user)
{
    $request->validate([
        'permission' => 'required|exists:permissions,name',
    ]);

    $user->givePermissionTo($request->permission);


        return response()->json(['message' => 'permission succesfully given to this user' ]);
}
}
