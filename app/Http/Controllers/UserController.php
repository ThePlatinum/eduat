<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  //
  public function profile()
  {
    $user = Auth::user()->lastname;
    return view('components.profile', ['user'=>$user]);
  }

  public function editprofile()
  {
    return view('common.editprofile');
  }
}
