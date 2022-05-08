<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
  //
  public function items()
  {
    return view('components.items');
  }

  public function create()
  {
  }

  public function additem()
  {
    return view('items.edit');
  }

  public function edititem()
  {
  }
}
