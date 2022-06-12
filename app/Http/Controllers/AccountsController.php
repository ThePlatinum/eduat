<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Items;
use App\Models\Payments;
use App\Models\StudentClasses;
use App\Models\Studentitems;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
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
    if (Auth()->user()->roles[0]->name == 'Accountant') {
      $students = User::with('class')->whereHas("roles", function ($q) {
        $q->where("name", "Student");
      })->get();
      
      return view('accounts.list', compact('students'));
    } else {
      $payments = Payments::with('class')->where('student_id', Auth()->user()->id)->get();
      $per_classes = $this->studentAccount(Auth()->user()->id);
      return view('accounts.student', compact('per_classes','payments'));
    }
  }

  public function getaccounts($student_id)
  {
    $student = User::with('studentclasses')->find($student_id);
    $classes = $student->studentclasses;

    $per_classes = [];
    foreach ($classes as $klass) {
      $clss = Klass::where('id', $klass->class_id)->first();

      $items = Studentitems::where('student_id', $student_id)
        ->where('class_id', $klass->class_id)->get()
        ->pluck('item');

      $cost = 0;
      foreach ($items as $item) {
        $cost += $item->price;
      }
      
      $per_classes[] = [
        'class' => $clss,
        'items' => $items,
        'items_total' => $cost,
      ];
    }

    $payments = Payments::with('class')->where('student_id', $student_id)->get();
    return view('accounts.student', compact('student', 'per_classes', 'payments'));
  }

  public function studentAccount($student_id)
  {
    $studentClasses = StudentClasses::where('student_id',$student_id)->get();
    $fee_per_classes = [];
    $tution = 0;
    foreach ($studentClasses as $student) {
      $items = Studentitems::where('student_id', $student_id)
        ->where('class_id', $student->class_id)
        ->get();
      $theItems = [];
      $itemtotal = 0;
      foreach ($items as $item) {
        $it = Items::find($item->item_id);
        $theItems[] = $it;
        $itemtotal = $itemtotal + $it->price;
      }
      $classes = Klass::find($student->class_id);
      $tution = $tution + array_sum($classes->fees);
      $fee_per_classes[] = ['items'=>$theItems, 'class'=>$classes, 'itemtotal'=>$itemtotal, 'tution'=>$tution];
    }
    return $fee_per_classes;
  }

  public function storepayment(Request $request){
    $paid = Payments::create([
      'student_id' => $request->student_id,
      'paid_in_class_id' => $request->class_id,
      'paid_in_term_id' => 1,
      'receipt_number' => $request->receipt_number,
      'ammount' => $request->ammount,
      'paydate' => $request->paydate,
      'note' => $request->note,
    ]);
    if ($paid)
      return back()->with('message', 'Payment record added successfully');
  }
}
