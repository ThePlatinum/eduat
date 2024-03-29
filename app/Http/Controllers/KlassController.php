<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\ClassTeacher;
use App\Models\Settings;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KlassController extends Controller
{
    //
  public function index()
  {
    $classes = Klass::with('subjects', 'teacher', 'students')->orderBy('name', 'Asc')->get();
    return view('classes.index', compact('classes'));
  }

  public function addclass(){

    $teachers = User::whereHas("roles", function($q) {
      $q->where("name", "Teacher");
    })->get();

    $session = Settings::where("name", "sessions")->first()->value;
    return view('classes.add', compact("session", "teachers"));
  }
  
  public function create(Request $request){
    $validator = Validator::make($request->all(), [
      'teacher' => 'required|exists:users,id',
      'name' => 'required|string|max:255',
      'fees' => 'required'
    ]);
    
    if ($validator->fails()) return back()->withErrors($validator)->withInput();

    $class = Klass::create([
      'name' => $request->name,
      'fees' => explode(',', $request->fee1.','.$request->fee2.','.$request->fee3),
    ]);
    
    if($request->teacher){
      ClassTeacher::create([
        'class_id' => $class->id,
        'teacher_id' => $request->teacher,
      ]);
    }

    return back()->with('message', 'Class added successfully');
  }

  public function edit($class_id){

    $teachers = User::whereHas("roles", function($q) {
      $q->where("name", "Teacher");
    })->get();

    $class = Klass::find($class_id);
    $session = Settings::where("name", "sessions")->first()->value;
    return view('classes.add', compact("session", "class", "teachers"));
  }

  public function editclass(Request $request){

    $validator = Validator::make($request->all(), [
      'teacher' => 'required|exists:users,id',
      'name' => 'required|string|max:255',
      'fees' => 'required'
    ]);
    
    if ($validator->fails()) return back()->withErrors($validator)->withInput();

    $class = Klass::find($request->class);
    if($class){
      $class->name = $request->name;
      $class->fees = explode(',', $request->fee1.','.$request->fee2.','.$request->fee3);
      $class->save();
    }
    
    $teacher = ClassTeacher::find($request->class);
    if($teacher) {
      $teacher->teacher_id = $request->teacher;
      $teacher->save();
    }
    else{
      ClassTeacher::create([
        'class_id' => $request->class,
        'teacher_id' => $request->teacher,
      ]);
    }
    
    return back()->with('message', 'Class updated successfully');
  }
  
  public function viewclass($class_id){
    $teachers = User::whereHas("roles", function($q) {
      $q->where("name", "Teacher");
    })->get();
    $class = Klass::with('teacher','students','subjects')->find($class_id);

    return view('classes.view', compact('class', 'teachers'));
  }

  public function createsubject(Request $request){
    Subjects::create([
      'name' => $request->name,
      'class_id' => $request->class,
      'teacher_id' => $request->teacher,
    ]);

    return back()->with('message', 'Subject added successfully');
  }

  public function editsubject(Request $request){

    Subjects::where("id", $request->subject)->update([
      'name' => $request->name,
      'class_id' => $request->class,
      'teacher_id' => $request->teacher,
    ]);

    return back()->with('message', 'Subject updated successfully');
  }
  
}
