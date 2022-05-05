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
    return view('components.profile', compact('user'));
  }

  public function viewprofile($user_id){
    $user = User::find($user_id);
    return view('common.viewprofile', compact($user));
  }

  public function editprofile()
  {
    return view('common.editprofile');
  }
}
