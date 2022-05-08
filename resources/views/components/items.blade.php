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
  </div>
  </div>
@endsection