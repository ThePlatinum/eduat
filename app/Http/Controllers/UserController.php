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
    $user = auth()->user();
    return view('profile.index', compact('user'));
  }

  public function viewprofile($user_id){
    $user = User::find($user_id);
    return view('profile.viewprofile', compact('user'));
  }

  public function editprofile()
  {
    return view('profile.editprofile');
  }
}
