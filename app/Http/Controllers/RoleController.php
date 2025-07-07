<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function updateRole(Request $request, User $user){

        
        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]); 


        $user->syncRoles([$request->role]);

  return response()->json(['message' => 'User role updated successfully']);

    
    
    }

    

}
