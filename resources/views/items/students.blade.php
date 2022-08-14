@extends('layouts.app')

@section('content')
<div class="d-flex flex-column">
  <div class="header bg-light p-3">
    <h5>Items</h5>
  </div>
  <div class="page p-3 flex-grow-1">

    <div class="row">
      @forelse ($items as $item)
      <div class="col-4">
        <div class="card card-body">
          <h5>{{$item->name}}</h5>
          <div class="d-flex justify-content-between">
            <p>{{$item->description}}</p>
            <p class="text-end"><span class="price btn-danger"> &#8358;{{$item->price}}</span></p>
          </div>
          <p>
            @if (is_array($item->class_for))
            @foreach ($item->class_for as $c)
            @php
            $class = App\Models\Klass::find($c);
            @endphp
            <span class="btn btn-sm btn-outline-primary px-2"><small>{{$class->name}}</small></span>&nbsp;
            @endforeach
            @elseif ($item->class_for == null)
            <span class="btn btn-sm btn-outline-primary px-2"> <small>All Classes</small> </span>
            @else
            <span class="btn btn-sm btn-outline-primary px-2"> <small>{{App\Models\Klass::find( str_replace(['"',','],'',$item->class_for) )->name}}</small> </span>
            @endif
          </p>
          <div class="d-flex justify-content-end">
            <form action="{{route('createstudentitem')}}" method="POST">
              <input type="number"  min='0'name="item_id" value="{{$item->id}}" hidden />
              @csrf
              <button type="submit" class="btn btn-secondary m-0">Add to my List</button>
            </form>
          </div>
        </div>
      </div>
      @empty
      <div class="text-center p-5">
        No Items added yet.
      </div>
      @endforelse
    </div>
  </div>
</div>
@endsection