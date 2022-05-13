<?php

namespace App\Http\Controllers;

use App\Models\Classes;
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
}
