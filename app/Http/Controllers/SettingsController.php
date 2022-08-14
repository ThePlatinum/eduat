<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Settings;
use App\Models\StudentKlass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
  //
  public function settings()
  {
    $classes = Klass::all();
    $supers = User::whereHas("roles", function($q) {
      $q->where("name", "Admin");
    })->get();
    $accountants = User::whereHas("roles", function($q) {
      $q->where("name", "Accountant");
    })->get();
    $admins = ['super' => $supers, 'accountant' => $accountants];
    return view('components.settings', compact('classes', 'admins'));
  }

  public function migrateclass(Request $request){
    $allclasses = Klass::Where('id', '!=', 1)->get()->sortByDesc('id');
    foreach ($allclasses as $class) {
      $c = str_replace(' ', '_', $class->name);
      $all[] = $request->$c;
    }
    dd($all);
    foreach ($all as $c) {
      if ($c != '1' && $this->count_in_array($c, $all) != 1) {
        return back()->with('formerror', 'Trying to migrate two classes to one?');
      }
      else{
        // foreach ($allclasses as $class) {
        //   $cn = str_replace(' ', '_', $class->name);
        //   if ($c = $request->$cn){
        //     $inclass = StudentKlass::Where('class_id', $class->id)->get();
        //     foreach ($inclass as $students) {
        //       StudentKlass::create([
        //         'class_id'=>$c,
        //         'student_id'=>$students->student_id,
        //       ]);
        //     }
        //   }
        // }
        return back()->with('success','Migrations successful');
      }
    }
  }

  public function count_in_array($a, $array){
    $count = 0;
    foreach ($array as $el)
      if($a == $el) $count += 1;
    return $count;
  }


  public function create_admin(Request $request)
  {
    $validator = validator($request->all(), [
      'firstname' => 'required|string|max:255|min:2',
      'lastname' => 'required|string|max:255|min:2',
      'role' => 'required|string',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|confirmed|min:8',
    ]);

    if ($validator->fails())
      return back()->withErrors($validator)
        ->withInput()->with('error', $validator->errors()->first());

    $user = User::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    if ($request->role == 'admin') {
      $user->assignRole('Admin');
    }
    if ($request->role == 'accountant') {
      $user->assignRole('Accountant');
    }

    return back()->with('success', 'Teacher added successfully');
  }

  public function delete(Request $request) {
    $admin = User::find($request->admin_id);
    if (!$admin) return back()->withErrors('error', 'Invalid User');
    $admin->delete();

    \Illuminate\Support\Facades\Session::flash('success', 'Account deleted successfully');
    return ;
  }

  public function edit_school_name(Request $request){
    if (count_chars($request->new_name) < 2) {
      \Illuminate\Support\Facades\Session::flash('error', "This is your school's name, make it valid");
      return ;
    }
    $name = Settings::Where('name', 'school_name')->first();
    $name->value = $request->new_name;
    // dd(count_chars($request->new_name));
    $name->save();

    \Illuminate\Support\Facades\Session::flash('success', 'Change Successful!');
    return ;
  }
}
