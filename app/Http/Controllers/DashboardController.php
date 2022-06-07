<?php

namespace App\Http\Controllers;

use App\Models\Klass;
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
    $classes = Klass::all()->count();
    $items = Items::all()->count();
    $counts = ['students' => $students, 'teachers' => $teachers, 'classes' => $classes, 'items' => $items];

    if (Auth()->user()->roles[0]->name == 'Student') {
      $curentclass = Klass::with('subjects', 'teacher')->find(Auth()->user()->klass_id);
      return view('dashboard.index', compact('curentclass'));
    } else
      return view('dashboard.index', compact('counts'));
  }
}
