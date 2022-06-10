<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
  public function index()
  {
    if (Auth()->user()->roles[0]->name == 'Student') {
      $curentclass = Klass::with('subjects', 'teacher')->find(Auth()->user()->klass_id);

      return view('subjects.student', compact('curentclass'));
    }
  }
}
