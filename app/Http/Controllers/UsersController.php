<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;
use Validator;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function show($user_id, User $user){
        $user = User::where('id', $user_id)
        ->firstOrFail();
        
        $posts = Post::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('user/show', ['user' => $user, 'posts' => $posts]);
    }
    public function edit(){
        $user = Auth::user();
        return view('user/edit',['user' => $user]);
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_password' => 'required|string|min:6|confirmed',
            'introduction'  => 'required|string|max:400'
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $user = User::find($request->id);
        $user->name = $request->user_name;
        $user->introduction = $request->introduction;
        if($request->user_profile_photo != null){
            $request->user_profile_photo->storeAs('public/user_images', $user->id. '.jpg');
            $user->profile_photo = $user->id. '.jpg';
        }
        $user->password = bcrypt($request->user_password);
        $user->save();
        
        return redirect('/users/'. $request->id);
    }
}