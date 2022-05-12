<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class AccountsController extends Controller
{

  use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $items = Items::all()->count();
        // return view('components.dashboard', compact('items'));
        
        if ( Auth()->user()->roles[0]->name == 'Accountant' ) {
          $students = User::with('class')->whereHas("roles", function($q) {
            $q->where("name", "Student");
          })->get();

          $eachstudent = [];
          foreach ($students as $student) {
            $current = $student->class[0];
            $theclass = Classes::find($current->class_id);
            $schoolFee = $theclass->fees[1];
            $eachstudent[] = ['student'=>$student, 'fee'=>$schoolFee, 'class'=>$theclass->name];
          }
          return view('accounts.list', compact('eachstudent'));
        }
        else{
          return view('accounts.student');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
