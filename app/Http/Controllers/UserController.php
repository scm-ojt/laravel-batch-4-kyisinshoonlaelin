<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function list()
    {
        $users = User::latest()->paginate(10);

        return view('admins.users.index', compact('users')); 
    }

    public function show(User $user) {

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request,User $user)
    {
        // $user = User::find($id); 
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        if(isset($request->image)){
            if($user->image->name != 'profile1.png'){
                $image_path = $user->image->path;
                unlink($image_path);
            }
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('images'), $imageName);
            $image = Image::where('imageable_id', $user->id)->update([
                'name' => $imageName,
                'path' => 'images/'.$imageName,
            ]);
        }
        
        return redirect()->route('users.show',$user->id);
    }
}