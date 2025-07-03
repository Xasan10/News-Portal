<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function assignrole(Request $request, User $user){

        
        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);

        $user->assignRole($request->role);

        return response()->json(['message'=>'user assigned to the role succesfully']);
    
    
    }

    public function removerole(Request $request, User $user){

                $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->removeRole($request->role);

          return response()->json(['message'=>'role succesfully removed from user']);

    }


}
