@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Items</h5>
  </div>
  <div class="page p-3 flex-grow-1">
    <div class="text-end">
      <a href=" {{ route('additem') }} " class="btn btn-primary">
        <i class='bx bx-list-plus'></i> <span>New Item</span>
      </a>
    </div>

    <div class="row">
      @foreach ($items as $item)
      <div class="col-4">
        <div class="card card-body">
          <h5> {{$item->name}} </h5>
          <p> <span class="price btn-danger"> N {{$item->price}} </span></p>
          <div >
          For Class(s): <br>
            @if (is_array($item->class_for))
            @foreach ($item->class_for as $c)
            @php
            $class = App\Models\Classes::find($c);
            @endphp
            <span class="btn btn-sm btn-outline-primary px-2"> {{$class->name}} </span>&nbsp;
            @endforeach
            @else
            <span class="btn btn-sm btn-outline-primary px-2"> {{App\Models\Classes::find( str_replace(['"',','],'',$item->class_for) )->name}} </span>
            @endif
          </div>
          
          <p> {{$item->description}} </p>
          <div class="d-flex gap-3">
          <a href=" {{route('updateitem', $item->id)}} " class="btn btn-secondary">Edit</a>
          <a href=" {{route('deleteitem', $item->id)}} " class="btn btn-outline-danger">Delete</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection