<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    

public function index() {
    $users = DB::table('users')->get();
    return view('users.index', compact('users'));
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
        'password' => Hash::make($data['password']),
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
        'password' => 'nullable|min:6|confirmed',
    ]);

    $updateData = [
        'name' => $data['name'],
        'email' => $data['email'],
        'updated_at' => now(),
    ];

    if (!empty($data['password'])) {
        $updateData['password'] = Hash::make($data['password']);
    }

    DB::table('users')->where('id', $id)->update($updateData);

    return redirect()->route('users.index')->with('success', 'User updated!');
}

public function destroy($id) {
    DB::table('users')->where('id', $id)->delete();
    return redirect()->route('users.index')->with('success', 'User deleted!');
}

}
