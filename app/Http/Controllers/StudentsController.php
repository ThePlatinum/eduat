<?php

namespace App\Http\Controllers;

use App\Models\StudentClasses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
  //
  public function students()
  {
    $students = User::whereHas("roles", function($q) {
      $q->where("name", "Student");
    })->get();
    return view('components.students', compact("students"));
  }

  public function newstudent()
  {
    return view('students.admission');
  }

  public function admission(Request $request){
    $user = User::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'othername' => $request->othername,
      'email' => $request->email,
      'phone' => $request->phone,
      'gender' => $request->gender,
      'dob' => $request->dob,
      'password' => Hash::make($request->firstname),
    ]);
    $user->assignRole('Student');

    return back()->with('message', 'New student added successfully');
  }
}
