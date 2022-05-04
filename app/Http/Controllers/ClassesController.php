<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    //
  public function index()
  {
    return view('components.classes');
  }

  public function addclass(){
    return view('classes.add');
  }
  
  public function create(Request $request){
    return back();
  }
  
  public function view(){
    return view('classes.view');
  }
  
  public function edit(Request $request){
    return view('classes.add');
  }
  
}
