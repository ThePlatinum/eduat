@extends('items.item')

@section('item')
<div class="text-end">
  <a href=" {{ route('additem') }} " class="btn btn-primary">
    <i class='bx bx-list-plus'></i> <span>New Item</span>
  </a>
</div>

<div class="row">
  @forelse ($items as $item)
  <div class="col-4">
    <div class="card card-body">
      <h5> {{$item->name}} </h5>
      <div>
      <div class="d-flex justify-content-between">
        <p>{{$item->description}}</p>
        <h6 class="text-end"><span class="price btn-danger"> &#8358;{{$item->price}} </span></h6>
      </div>
        <p>
          For Class<small>(s)</small>:
          <br>
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
      </div>
      <div class="d-flex gap-3">
        <a href=" {{route('updateitem', $item->id)}} " class="btn btn-secondary">Edit</a>
        <a href=" {{route('deleteitem', $item->id)}} " class="btn btn-outline-danger">Delete</a>
      </div>
    </div>
  </div>
  @empty
  <div class="text-center p-5">
    No Items added yet.
  </div>
  @endforelse
</div>
@endsection