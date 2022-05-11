@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5> {{ isset($item)  ? 'Update Item' : 'Create Item'}} </h5>
    <!-- TODO: Change this in class too -->
  </div>

  <div class="page p-3 flex-grow-1">
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif

    <div class="text-end">
      <a href=" {{ route('items') }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>

    <div class="justify-content-center d-flex ">
      <div class="col-md-8">
        <form method="POST" action="{{ isset($item)  ?  route('edititem') : route('create') }}" class=" p-3">
          @csrf
          <input id="item" type="class" value="{{$item->id ?? ''}}" name="item_id" hidden>

          <div class="col py-2">
            <label for="name" class="col-md-4 col-form-label">{{ __('Item Name') }}</label>
            <input id="name" type="name" value="{{$item->name ?? '' }}" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col py-2">
            <label for="price" class="col-md-4 col-form-label">{{ __('Price') }}</label>
            <div class="d-flex">
              <a class="btn"> N </a>
              <input id="price" type="number" value="{{$item->price ?? '' }}" class="flex-grow-1 form-control @error('price') is-invalid @enderror" name="price" required autofocus>
            </div>
            @error('price')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col py-2">
            <label for="" class="col-md-4 col-form-label ">{{ __('Classes item is compulsory for:') }}</label>
            <div class="row px-3">
              @foreach($classes as $class)
              <div class="col-md-3">
              <input type="checkbox" id="classfor{{$loop->index}}" name="classfor[]" value="{{ $class->id ?? '' }}"/>
              <label for="classfor{{$loop->index}}"> {{$class->name ?? ''}} </label>
                @error('classfor')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              @endforeach
            </div>
          </div>

          <div class="col py-2">
            <label for="desc" class="col-md-4 col-form-label">{{ __('Description') }}</label>
            <textarea id="desc" class="flex-grow-1 form-control @error('desc') is-invalid @enderror" name="desc" autofocus>{{$item->description ?? '' }}</textarea>
            @error('desc')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="col d-flex gap-3 py-3">
            <button type="reset" class="btn btn-secondary block">
              {{ __('Reset') }}
            </button>
            <button type="submit" class="btn btn-primary block">
              {{ isset($item)  ? 'Update Item' : 'Create Item'}}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection