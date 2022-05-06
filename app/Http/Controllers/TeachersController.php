<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    //
  public function teachers()
  {
    $teachers = User::whereHas("roles", function($q) {
      $q->where("name", "Teacher");
    })->get();
    return view('components.teachers', compact("teachers"));
  }

  public function newteacher()
  {
    return view('teachers.employ');
  }

  public function employ(Request $request){

    $user = User::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'othername' => $request->othername,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => Hash::make($request->firstname),
    ]);
    $user->assignRole('Teacher');

    return back()->with('message', 'Teacher added successfully');
  }
}
