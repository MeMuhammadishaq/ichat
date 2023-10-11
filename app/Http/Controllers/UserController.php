<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class UserController extends Controller
{
    public function read(Request $request){
        $read = User::whereNot('id', auth()->user()->id)->get();
        
        return view('welcome',compact('read'));
        
    }
    public function profile(){
        $profile = User::where('id', auth()->user()->id)->firstOrFail();
        return view('setting',compact('profile'));
    }
    public function upload(Request $request){
        $upload = User::findOrFail($request->id);
        if ($request->hasFile('image')) {
         $image = $request->file('image');
         $imageName = time() . '.' . $image->getClientOriginalExtension();
         $image->move(public_path('images'), $imageName);
         $upload-> image =$imageName;
     }
     $upload->name =$request['name'];
     $upload->save();
     return redirect('/')->with('message','record updated successfully');
    }
    
   
}
