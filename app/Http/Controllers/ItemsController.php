<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Models\Items;
use App\Models\Studentitems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
  //
  public function items()
  {
    $items = Items::all();
    if ( Auth()->user()->roles[0]->name == 'Accountant' )
      return view('components.items', compact('items'));
    else
      return view('items.students', compact('items'));
  }

  public function create(Request $request)
  {
    $classfor = '"';
    foreach ($request->classfor as $for) {
      $classfor .= $for.',';
    }
    $classfor .= '"' ;
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
    $classes = Klass::where('id', '!=', '1')->get();
    return view('items.add', compact('classes'));
  }

  public function edititem($item_id)
  {
    $item = Items::find($item_id);
    $classes = Klass::where('id', '!=', '1')->get();
    return view('items.add', compact('item', 'classes'));
  }

  public function edit(Request $request)
  {
    $classfor = '"';
    foreach ($request->classfor as $for) {
      $classfor .= $for.',';
    }
    $classfor .= '"' ;
    $item = Items::find($request->item_id);
    $item->name = $request->name;
    $item->description = $request->desc;
    $item->price = $request->price;
    $item->class_for = $request->classfor;
    $item->save();

    return back()->with('message', 'Item updated successfully');
  }

  public function deleteitem($item_id)
  {
    Items::where('id',$item_id)->delete();
    return back()->with('message', 'Item deleted successfully');
  }


  public function createstudentitem(Request $request){
    $student_id = Auth()->user()->id;
    $student = User::where('id',$student_id)->with('class')->get();
    $class = $student[0]->class[0];
    Studentitems::updateOrCreate([
      'student_id' => $student_id,
      'item_id' => $request->item_id,
      'class_id' => $class->class_id,
    ]);
    return back()->with('message', 'Item added to your list successfully');
  }
}