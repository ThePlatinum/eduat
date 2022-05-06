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
    return view('components.classes');
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
  
  public function view(){
    return view('classes.view');
  }
  
  public function edit(Request $request){
    return view('classes.add');
  }
  
}
