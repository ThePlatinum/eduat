<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Items;
use App\Models\User;

class DashboardController extends Controller
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
      $curentclass = Classes::with('subjects', 'teacher')->find(Auth()->user()->current_class);
      return view('dashboard.index', compact('student', 'curentclass'));
    } else
      return view('dashboard.index', compact('counts'));
  }
}
