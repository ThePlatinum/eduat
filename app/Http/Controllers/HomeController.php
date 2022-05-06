<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

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
    $students = User::whereHas("roles", function($q) {
      $q->where("name", "Student");
    })->count();

    $teachers = User::whereHas("roles", function($q) {
      $q->where("name", "Teacher");
    })->count();

    $classes = Classes::all()->count();

    $counts = ['students'=>$students, 'teachers'=>$teachers, 'classes'=>$classes];
    return view('components.dashboard', compact('counts','settings'));
  }
}
