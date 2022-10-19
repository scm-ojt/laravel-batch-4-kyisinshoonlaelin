<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return view('users.list', compact('users')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $user ->name = $request->get('name');
        $user ->email = $request->get('email');
        $user ->phone = $request->get('phone');
        $user ->address = $request->get('address');
        $user -> save();

        return redirect()->route('users.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $email= $user -> email;
        $product = Product::where('user_id',$id)->delete();
        $user->delete();

        Mail::to($email)->send(new NotifyMail());


 
      /* if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         } */

        return redirect()->route('users.list');
    }
}