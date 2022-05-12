@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Items</h5>
  </div>
  <div class="page p-3 flex-grow-1">

    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
      @foreach ($items as $item)
      <div class="col-4">
        <div class="card card-body">
          <h5> {{$item->name}} </h5>
          <p> Cost: &nbsp; <span class="price btn-danger"> &#8358; {{$item->price}} </span></p>
          <div>
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
          <div class="py-3">
            {{$item->description}}
          </div>
          <div class="d-flex gap-3">
            <form action="{{route('createstudentitem')}}" method="POST">
              <input type="number" name="item_id" value="{{$item->id}}" hidden />
              @csrf
              <button type="submit" class="btn btn-secondary m-0">Add to my List</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection