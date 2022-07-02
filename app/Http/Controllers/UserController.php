<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function viewprofile($user_id = null){
    if ($user_id == null) {
      $user = auth()->user();
    } else {
      $user = User::find($user_id);
    }
    return view('profile.index', compact('user'));
  }

  public function editprofile($user_id)
  {
    $user = User::find($user_id);
    return view('profile.editprofile', compact('user'));
  }

  public function update(Request $request){
    $user = User::find($request->user_id);
    $validator = Validator::make($request->all(), [
      'firstname' => 'required|string|max:255',
      'lastname' => 'required|string|max:255',
      'othername' => 'nullable|string|max:255',
      'email' => 'required|email|max:255|unique:users,email,'.$user->id,
      'phone' => 'required|string|max:255',
      'address' => 'required|string|max:255',
      'gender' => "required|in:Male,Female",
      'dob' => 'nullable|date',
      'bio' => 'nullable|string|min:2',
      'old_password' => 'nullable|current_password',
      'new_password' => 'nullable|min:6|required_with:old_password',
      'profile_image' => 'nullable|image|mimes:jpeg,png,jpg',
    ]);

    if ($validator->fails())
      return back()->withErrors($validator)->withInput();

    if ($request->hasFile('profile_image')) {
      if ($user->image != 'avater.png') {
        Storage::delete($user->image);
      }
      $image = $request->file('profile_image');
      $name = 'profile'.$user->id.'.'.$image->getClientOriginalExtension();
      $image->storeAs('profile', $name);
      $user->image = 'profile/'.$name;
    }

    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->othername = $request->othername;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->gender = $request->gender;
    if ($request->dob != null) {
      $user->dob = $request->dob;
    }
    if ($request->new_password != null) {
      $user->password = Hash::make($request->new_password);
    }
    if ($request->bio != null) {
      $user->bio = $request->bio;
    }

    if (($request->user_id == auth()->user()->id) || (auth()->user()->roles->pluck('name')[0] == 'Admin')) {
      $user->save();
      return redirect()->route('viewprofile', $user->id)->with('message', 'Profile updated successfully');
    } else {
      return back()->with('message', 'You are not authorized to perform this action');
    }
  }
}
