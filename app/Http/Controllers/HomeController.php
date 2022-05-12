<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Items;
use App\Models\User;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $students = User::whereHas("roles", function ($q) {
      $q->where("name", "Student");
    })->count();
    $teachers = User::whereHas("roles", function ($q) {
      $q->where("name", "Teacher");
    })->count();
    $classes = Classes::all()->count();
    $items = Items::all()->count();
    $counts = ['students' => $students, 'teachers' => $teachers, 'classes' => $classes, 'items' => $items];

    if (Auth()->user()->roles[0]->name == 'Student') {
      $student = User::with('class')->find(Auth()->user()->id);
      $curentclass = Classes::with('subjects', 'teacher')->find($student->class[0]->class_id);
      return view('components.dashboard', compact('student', 'curentclass'));
    } else
      return view('components.dashboard', compact('counts'));
  }
}
