<?php

namespace App\Http\Controllers;

use App\Models\Classes;
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
    $classes = Classes::all();
    return view('students.admission', compact('classes'));
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

    // Assign class
    StudentClasses::create([
      'student_id' => $user->id,
      'class_id' => $request->class,
    ]);

    return back()->with('message', 'New student added successfully');
  }
}
