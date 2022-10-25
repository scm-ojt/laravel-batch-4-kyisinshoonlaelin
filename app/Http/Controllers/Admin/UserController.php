<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\AdminUserCreateRequest;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        $imageName = 'profile1.png'; 
        Image::create([
            'imageable_id' => $user->id,
            'imageable_type' => get_class($user),
            'name' => $imageName,
            'path' => 'images/'.$imageName,
        ]);
        
        return redirect()->route('admins.users.list');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admins.users.index', compact('users')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admins.users.edit', compact('user'));
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
        return redirect()->route('admins.users.list');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('admins.users.list');
    }
}