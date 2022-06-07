<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Items;
use App\Models\Subjects;
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
    $_id = Auth()->user()->id;

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
    }
    else if (Auth()->user()->roles[0]->name == 'Teacher') {
      $teaches = Subjects::with('class')->where('teacher_id', $_id)->get();
      $all_students = 0 ;
      foreach ($teaches as $subject) {
        $all_students += $subject->class->student_count;
      }
      return view('dashboard.index', compact('teaches', 'all_students'));
    }
    else if (Auth()->user()->roles[0]->name == 'Accountant'){
      return view('dashboard.index', compact('counts'));
    }
    else
      return view('dashboard.index', compact('counts'));
  }
}
