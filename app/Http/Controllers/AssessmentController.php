<?php

namespace App\Http\Controllers;

use App\Mail\ScoreAdded;
use App\Models\Assessment;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AssessmentController extends Controller
{
    //
  public function gradingview($assessment_id){
    $assessment = Assessment::with('subject', 'scores')->find($assessment_id);
    return view('assessment.gradingview', compact('assessment'));
  }
  
    //
  public function create(Request $request){
    $validator = Validator::make($request->all(), [
      'subject_id' => 'required|exists:subjects,id',
      'type' => 'required|string',
      'title' => 'nullable|string',
      'grade_point' => 'required|integer',
      'assessed_at' => 'nullable|date',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }

    $term_id = '1';
    $cesion_id = '1';

    $assessment = Assessment::create([
      'subject_id' => $request->subject_id,
      'cesion_id' => $cesion_id,
      'term_id' => $term_id,
      'type' => $request->type,
      'title' => $request->title,
      'grade_point' => $request->grade_point,
      'assessed_at' => $request->assessed_at,
    ]);

    if ($assessment)
      return back()->with('success', 'Assessment created successfully');
  }

  public function addscore(Request $request, $assessment_id){
    if ($request->ajax()) {
      $user = User::find( $request->pk );
      
      if (! $user) {
        return response()->json(['error' => 'User not found'], 401);
      }
      
      $score = Score::where('user_id', $user->id)
        ->where('assessment_id', $assessment_id)
        ->first();
      
      if ($request->name == 'score') {
        if (! $score) {
          $score = Score::create([
            'user_id' => $user->id,
            'assessment_id' => $assessment_id,
            'score' => $request->value,
          ]);

          try {
            Mail::to($user)->send(new ScoreAdded($score));
          } catch (\Throwable $th) {
            //throw $th;
          }
        } else {
          $score->score = $request->value;
          $score->save();
        }
      }

      else if ($request->name == 'remark') {
        if (! $score) {
          $score = Score::create([
            'user_id' => $user->id,
            'assessment_id' => $assessment_id,
            'remarks' => $request->value,
          ]);
        } else {
          $score->remarks = $request->value;
          $score->save();
        }
      }

      return response()->json(['success' => true]);
    }
  }

}
