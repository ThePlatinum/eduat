<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\StudentClasses;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
  //
  public function settings()
  {
    $classes = Classes::all();
    $supers = User::whereHas("roles", function($q) {
      $q->where("name", "Admin");
    })->get();
    $accountants = User::whereHas("roles", function($q) {
      $q->where("name", "Accountant");
    })->get();
    $admins = ['super' => $supers, 'accountant' => $accountants];
    return view('components.settings', compact('classes', 'admins'));
  }

  public function migrateclass(Request $request){
    $allclasses = Classes::Where('id', '!=', 1)->get()->sortByDesc('id');
    foreach ($allclasses as $class) {
      $c = str_replace(' ', '_', $class->name);
      $all[] = $request->$c;
    }
    dd($all);
    foreach ($all as $c) {
      if ($c != '1' && $this->count_in_array($c, $all) != 1) {
        return back()->with('formerror', 'Trying to migrate two classes to one?');
      }
      else{
        foreach ($allclasses as $class) {
          $cn = str_replace(' ', '_', $class->name);
          if ($c = $request->$cn){
            $inclass = StudentClasses::Where('class_id', $class->id)->get();
            foreach ($inclass as $students) {
              StudentClasses::create([
                'class_id'=>$c,
                'student_id'=>$students->student_id,
              ]);
            }
          }
        }
        return back()->with('success','Migrations successful');
      }
    }
  }

  public function count_in_array($a, $array){
    $count = 0;
    foreach ($array as $el)
      if($a == $el) $count += 1;
    return $count;
  }
}
