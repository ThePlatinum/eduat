<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Subjects;
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

  public function subjectreport($subject_id)
  {
    $subject = Subjects::with('assessments')->find($subject_id);
    $assessments = $subject->assessments;

    $subject_assessments = "";
    $score_table = [];
    foreach ($assessments as $assessment) {
      $grade_point = $assessment->grade_point;
      $score = $assessment->scores->where('user_id', Auth()->user()->id)->first();
      $user_score = $score->score;
      $user_remark = $score->remarks ?? "No remark yet";
      $subject_assessments .= "['".$assessment->title."',".$user_score.",".$grade_point."],";

      $score_table[] = [
        'name' => $assessment->title,
        'score' => $user_score,
        'grade_point' => $grade_point,
        'remark' => $user_remark
      ];
    }
    
    return view('subjects.index', compact('subject', 'subject_assessments', 'score_table'));
  }
}
