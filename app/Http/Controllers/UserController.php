<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list() {
        $data = User::all();
        return view('users.list', [
        'users' => $data
        ]); 
    }
    public function edit($id) {
        $data = User::find($id);
        return view('users.edit', [
            'user' => $data
        ]);
    }
    public function update(Request $request, $id) {
        $validator = validator(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone'=> 'required|regex:/^([0][9]\-[0-9]+)$/|min:12',
            'address' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $user = User::find($id);
        $user ->name = $request->get('name');
        $user ->email = $request->get('email');
        $user ->phone = $request->get('phone');
        $user ->address = $request->get('address');
        $user -> save();
        return redirect('/users/list');

    }
    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/users/list');
    }
}
