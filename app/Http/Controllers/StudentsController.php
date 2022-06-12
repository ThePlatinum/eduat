<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\StudentClasses;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
  //
  public function students()
  {
    $students = User::whereHas("roles", function($q) {
      $q->where("name", "Student");
    })->get();
    return view('students.index', compact("students"));
  }

  public function newstudent()
  {
    $classes = Klass::all();
    return view('students.admission', compact('classes'));
  }

  public function admission(Request $request){

    $validator = Validator::make($request->all(), [
      'firstname' => 'required|string|max:255',
      'lastname' => 'required|string|max:255',
      'othername' => 'nullable|string|max:255',
      'email' => 'required|email:rfc|unique:users,email',
      'phone' => 'required|string|max:255',
      'address' => 'required|string|max:255',
      'gender' => ['required',Rule::in(['Male', 'Female'])],
      'dob' => 'required|date',
      'class' => 'required|exists:klasses,id'
    ]);

    if ($validator->fails())
      return back()->withErrors($validator)->withInput();

    $user = User::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'othername' => $request->othername,
      'email' => $request->email,
      'phone' => $request->phone,
      'gender' => $request->gender,
      'dob' => $request->dob,
      'address' => $request->address,
      'klass_id' => $request->class,
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
