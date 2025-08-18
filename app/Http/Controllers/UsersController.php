<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    

public function index() {
    $users = DB::table('users')->get();

    $roles = DB::table('roles')->get();
    return view('users.index', ['users' => $users,'roles' => $roles]);
}

public function create() {
    return view('users.create');
}

public function store(Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    DB::table('users')->insert([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => FacadesHash::make($data['password']),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('users.index')->with('success', 'User created!');
}

public function edit($id) {
    $user = DB::table('users')->where('id', $id)->first();
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'bio' =>'nullable|string',
        'password' => 'nullable|min:6|confirmed',
        'img' =>'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
    ]);
    $user = Auth::user();

   $imgPath = $user->img; 
if ($request->hasFile('img')) {
    if ($user->img) {
        Storage::disk('public')->delete($user->img);
    }
    $imgPath = $request->file('img')->store('img','public');
}

$updateData = [
    'name'  => $data['name'],
    'email' => $data['email'],
    'bio'   => $data['bio'] ?? null,
    'img'   => $imgPath,
];

    if (!empty($data['password'])) {
        $updateData['password'] = FacadesHash::make($data['password']);
    }

    DB::table('users')->where('id', $id)->update($updateData);

    return redirect()->route('profile',['id' => $id])->with('success', 'User updated!');
}

public function destroy($id) {
    DB::table('users')->where('id', $id)->delete();
    return redirect()->route('users.index')->with('success', 'User deleted!');
}



public function toggleBlock($id)
{
    $user = User::findOrFail($id);
    $user->is_blocked = !$user->is_blocked; // toggle
    $user->save();

    return back()->with('status', 'User ' . ($user->is_blocked ? 'blocked' : 'unblocked') . ' successfully.');
}








public function searchUser(Request $request){


    $searched = $request->input('search');

    $users = User::search($searched)->get();

 


return view('dashboard.usersearch',['users' => $users]);






}
public function showUsers(Request $request){



    $users = User::all();
    $user = Auth::user();

    $roles = DB::table('roles')->get();



    return view('dashboard.users',['users' => $users,'roles'=>$roles,'user'=>$user]);






}


}



