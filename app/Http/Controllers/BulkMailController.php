<?php

namespace App\Http\Controllers;

use App\Mail\BulkMail as MailBulkMail;
use App\Models\BulkMail;
use App\Models\Klass;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BulkMailController extends Controller
{
    //
  public function index()
  {
    $sentmails = Auth()->user()->sentmails;
    if (Auth()->user()->roles[0]->name == 'Admin') {
      $sentmails = BulkMail::all();
    }

    $classes = Klass::all();
    if (Auth()->user()->roles[0]->name == 'Teacher') {
      $teaches = Subjects::with('class')->where('teacher_id', Auth()->user()->id)->get();
      foreach ($teaches as $teach) {
        $allclass[] = $teach->class;
      }
      $allclass = array_unique($allclass);
      $classes = [];
      foreach ($allclass as $value) {
        $classes[] = $value;
      }
    }

    return view('bulkmail.index', compact('sentmails', 'classes'));
  }

  public function sendmail(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'to'        => 'required',
      'class_id'  => 'required_if:to,students_in',
      'subject'   => 'required|string',
      'content'   => 'required|string'
    ]);

    if ($validator->fails()) return back()->withErrors($validator)->withInput();

    $bulkmail = BulkMail::create([
      'user_id'   => Auth()->user()->id,
      'to'        => $request->to,
      'klass_id'  => $request->class_id,
      'subject'   => $request->subject,
      'content'   => $request->content
    ]);

    $all_students = User::whereHas("roles", function ($q) {
      $q->where("name", "Student");
    })->get();

    if ($request->to == 'all')
      $to = User::all();

    else if ($request->to == 'all_students')
      $to = $all_students;

    else if ($request->to == 'all_teachers')
      $to = User::whereHas("roles", function($q) {
        $q->where("name", "Teacher");
      })->get();

    else if ($request->to == 'all_staffs')
      $to = User::whereHas("roles", function ($q) {
        $q->where("name", '!=', "Student");
      })->get();

    else if ($request->to == 'students_in')
      $to = User::where('klass_id', $request->class_id)->get();

    else if ($request->to == 'defaulters')
      $to = $all_students->where('should_pay', '>', 0);

    else if ($request->to == 'non_defaulters')
      $to = $all_students->where('should_pay', '<=', 0);

    else return back()->with('error', 'Invalid reciever');

    try {
      Mail::to($to)->send(new MailBulkMail($bulkmail));
      return back()->with('message', 'Mails sent successfully');
    } catch (\Throwable $th) {
      $bulkmail->delete();
      return back()->with('error', 'Error Occured! Could not send mails');
    }
  }
}
