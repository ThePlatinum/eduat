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

      $subject_performance = "";
      foreach ($curentclass->subjects as $subject) {
        $user_score = 0;
        $grade_point = 0;
        foreach ($subject->assessments as $assessment ) {
          $grade_point += $assessment->grade_point;
          $user_score += $assessment->scores()->where('user_id', $_id)->first()->score;
        }
        $subject_performance .= "['".$subject->name."',".$user_score.",".$grade_point.",".(($user_score / $grade_point) * 100)."],";
      }
      
      return view('dashboard.index', compact('curentclass', 'subject_performance'));
    }
    else if (Auth()->user()->roles[0]->name == 'Teacher') {
      $teaches = Subjects::with('class')->where('teacher_id', $_id)->get();
      $all_students = 0;
      foreach ($teaches as $teach) {
        $allstudents[] = $teach->class->students;
      }
      $allstudents = array_unique($allstudents);
      $flatten_array = [];
      foreach ($allstudents as $value) {
        foreach ($value as $val ) {
          $flatten_array[] = $val;
        }
      }
      $all_students = sizeof($flatten_array);
      return view('dashboard.index', compact('teaches', 'all_students'));
    }
    else if (Auth()->user()->roles[0]->name == 'Accountant') {
      return view('dashboard.index', compact('counts'));
    }
    else
      return view('dashboard.index', compact('counts'));
  }
}
