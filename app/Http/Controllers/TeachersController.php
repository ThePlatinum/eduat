<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeachersController extends Controller
{
    //
  public function teachers()
  {
    $_teachers = User::whereHas("roles", function($q) {
      $q->where("name", "teacher");
    })->get();

    $teachers = [];
    foreach ($_teachers as $teacher ) {
      $teaches = Subjects::with('class')->where('teacher_id', $teacher->id)->get();
      $teachers[] = [
        'teacher' => $teacher,
        'subjects' => $teaches,
      ];
    }
    return view('teachers.index', compact("teachers"));
  }

  public function newteacher()
  {
    return view('teachers.employ');
  }

  public function employ(Request $request){

    $validator = validator($request->all(), [
      'firstname' => 'required|string|max:255|min:3',
      'lastname' => 'required|string|max:255',
      'othername' => 'nullable|string|max:255',
      'gender' => ['required',Rule::in(['Male', 'Female'])],
      'email' => 'required|string|email|max:255|unique:users',
      'phone' => 'required|string|max:255'
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    $user = User::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'othername' => $request->othername,
      'gender' => $request->gender,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => Hash::make($request->firstname),
    ]);
    $user->assignRole('Teacher');

    return back()->with('message', 'Teacher added successfully');
  }

  public function delete(Request $request) {
    $teacher = User::find($request->teacher_id);
    if (!$teacher) return back()->withErrors('error', 'Invalid User');
    $teacher->delete();

    \Illuminate\Support\Facades\Session::flash('message', 'Account deleted successfully');
    return ;
  }
}
