<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Items;
use App\Models\Studentitems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class AccountsController extends Controller
{

  use HasRoles;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    // $items = Items::all()->count();
    // return view('components.dashboard', compact('items'));

    if (Auth()->user()->roles[0]->name == 'Accountant') {
      $students = User::with('class')->whereHas("roles", function ($q) {
        $q->where("name", "Student");
      })->get();

      $eachstudent = [];
      foreach ($students as $student) {
        $current = $student->class[0];
        $theclass = Classes::find($current->class_id);
        $schoolFee = $theclass->fees[1];
        $eachstudent[] = ['student' => $student, 'fee' => $schoolFee, 'class' => $theclass->name];
      }
      return view('accounts.list', compact('eachstudent'));
    } else {
      $per_classes = $this->studentAccount(Auth()->user()->id);
      return view('accounts.student', compact('per_classes'));
    }
  }

  public function studentAccount($student_id)
  {
    //
    $student = User::with('class')->find($student_id);
    $fee_per_classes = [];
    $tution = 0;
    foreach ($student->class as $c) {
      $items = Studentitems::where('student_id', $student_id)->where('class_id',$c->class_id)->get();
      $theItems = [];
      $itemtotal = 0;
      foreach ($items as $item) {
        $it = Items::find($item->item_id);
        $theItems[] = $it;
        $itemtotal = $itemtotal + $it->price;
      }
      $classes = Classes::find($c->class_id);
      $tution = $tution + array_sum($classes->fees);
      $fee_per_classes[] = ['items'=>$theItems, 'class'=>$classes, 'itemtotal'=>$itemtotal, 'tution'=>$tution];
    }
    return $fee_per_classes;
  }
}
