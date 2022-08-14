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
use Illuminate\Support\Facades\Validator;
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
      $payments = Payments::with('class')
        ->where('student_id', Auth()->user()->id)
        ->orderBy('created_at', 'desc')->get();
      $student = Auth()->user();
      $per_classes = $this->studentAccount(Auth()->user()->id);
      return view('accounts.student', compact('student', 'per_classes','payments'));
    }
  }

  public function getaccounts($student_id)
  {
    $student = User::with('studentclasses')->find($student_id);
    $classes = $student->studentclasses;

    $per_classes = $this->studentAccount($student_id);

    $payments = Payments::with('class')
      ->where('student_id', $student_id)
      ->orderBy('created_at', 'desc')->get();
    return view('accounts.student', compact('student', 'per_classes', 'payments'));
  }

  public function studentAccount($student_id)
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
    return $per_classes;
  }

  public function storepayment(Request $request){
    $validator = Validator::make($request->all(),[
      'student_id' => 'exists:users,id',
      'paid_in_class_id' => 'exists:klasses,id',
      'receipt_number' => 'required|unique:payments,receipt_number',
      'ammount' => 'required|min:1',
      'paydate' => 'required|date',
      'note' => 'nullable|string',
    ]);

    if ($validator->fails())
      return back()->withErrors($validator)->withInput();
    
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
