<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Settings;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    //
  public function index()
  {
    $classes = Classes::with('students')->get();
    return view('components.classes', compact('classes'));
  }

  public function addclass(){
    $session = Settings::where("name", "sessions")->first()->value;
    return view('classes.add', compact("session"));
  }
  
  public function create(Request $request){

    Classes::create([
      'name' => $request->name,
      'level' => $request->level,
      'fees' => "[$request->fee1_, $request->fee2_, $request->fee3_]",
    ]);
    // if teacher is provided, add the teacher to the class
    return back()->with('message', 'Class added successfully');
  }
  
  public function viewclass($class_id){
    $class = Classes::with('students')->find($class_id);
    return view('classes.view', compact('class'));
  }
  
  public function edit(Request $request){
    return view('classes.add');
  }
  
}
