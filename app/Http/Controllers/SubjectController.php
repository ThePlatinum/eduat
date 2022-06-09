<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
  public function teacherview($subject_id){
    $subject = Subjects::with('class', 'assessments')->find($subject_id);

      return view('subjects.teacher', compact('subject'));
  }
}
