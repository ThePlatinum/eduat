<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
  //
  public function items()
  {
    $items = Items::all();
    return view('components.items', compact('items'));
  }

  public function create(Request $request)
  {
    $classfor = '"[';
    foreach ($request->classfor as $for) {
      $classfor .= $for.',';
    }
    $classfor .= ']"' ;
    Items::create([
      'name' => $request->name,
      'description' => $request->desc,
      'price' => $request->price,
      'class_for' => $classfor
    ]);

    return back()->with('message', 'Item added successfully');
  }

  public function additem()
  {
    $classes = Classes::where('id', '!=', '1')->get();
    return view('items.add', compact('classes'));
  }

  public function edititem($item_id)
  {
    $item = Items::find($item_id);
    $classes = Classes::where('id', '!=', '1')->get();
    return view('items.add', compact('item', 'classes'));
  }

  public function edit(Request $request)
  {
    $classfor = '"[';
    foreach ($request->classfor as $for) {
      $classfor .= $for.',';
    }
    $classfor .= ']"' ;
    $item = Items::find($request->item_id);
    $item->name = $request->name;
    $item->description = $request->desc;
    $item->price = $request->price;
    $item->class_for = $request->classfor;
    $item->save();

    return back()->with('message', 'Item updated successfully');
  }

}