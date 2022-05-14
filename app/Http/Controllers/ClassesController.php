<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassTeacher;
use App\Models\Settings;
use App\Models\StudentClasses;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    //
  public function index()
  {
    $allclass = Classes::with('subjects')->get();
    $group = StudentClasses::all()->groupBy('student_id');
    foreach ($group as $student ) {
      $currentclasses[] = $student->last();
    }
    $classes = [];
    foreach ($allclass as $class) {
      $inclass = [];
      foreach ($currentclasses as $current) {
        if ($current->class_id == $class->id) {
          $inclass[] = User::find($current->student_id);
        }
      }
      $classes[] = ['class' => $class, 'student'=>$inclass];
    }
    return view('components.classes', compact('classes'));
  }

  public function addclass(){

    $teachers = User::whereHas("roles", function($q) {
      $q->where("name", "Teacher");
    })->get();

    $session = Settings::where("name", "sessions")->first()->value;
    return view('classes.add', compact("session", "teachers"));
  }
  
  public function create(Request $request){

    $class = Classes::create([
      'name' => $request->name,
      'fees' => [$request->fee1, $request->fee2, $request->fee3],
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

    $class = Classes::find($class_id);
    $session = Settings::where("name", "sessions")->first()->value;
    return view('classes.add', compact("session", "class", "teachers"));
  }

  public function editclass(Request $request){
    $class = Classes::find($request->class);
    if($class){
      $class->name = $request->name;
      $class->fees = [$request->fee1, $request->fee2, $request->fee3];
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
    $class = Classes::with('teacher')->with('students')->find($class_id);
    if ($class->teacher != null)
      $classteacher = User::where('id', $class->teacher->teacher_id)->first();
    else
      $classteacher = 'No teacher assigned';
    $subjects = Subjects::with('teacher')->where("class_id", $class_id)->get();

    return view('classes.view', compact('class', 'teachers', 'subjects', 'classteacher'));
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
