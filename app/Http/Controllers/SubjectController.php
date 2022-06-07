<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
  public function teacher_view($subject_id){
    $subject = Subjects::with('class')->find($subject_id);

    if ($subject) {
      return view('subjects.teacher', compact('subject'));
    }
  }
}
