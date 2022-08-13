@extends('items.item')

@section('item')
<div class="justify-content-center d-flex py-5">
  <div class="col-md-6 bg-light p-3">
    <div class="header d-flex justify-content-between align-items-center p-3">
      <h5> {{ isset($item)  ? 'Update Item' : 'Create Item'}} </h5>
      <a href=" {{ route('items') }} " class="btn btn-secondary">
        <i class='fa fa-arrow-left'></i> <span>BACK</span>
      </a>
    </div>
    <form method="POST" action="{{ isset($item)  ?  route('edititem') : route('create') }}" class=" p-3">
      @csrf
      <input id="item" type="class" value="{{$item->id ?? ''}}" name="item_id" hidden>

      <div class="col py-2">
        <label for="name" class="col-form-label">{{ __('Item Name') }}</label>
        <input id="name" type="name" value="{{$item->name ?? '' }}" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col py-2">
        <label for="price" class="col-form-label">{{ __('Price') }}</label>
        <div class="d-flex">
          <a class="btn"> &#8358; </a>
          <input id="price" type="number"  min='0'value="{{$item->price ?? '' }}" class="flex-grow-1 form-control @error('price') is-invalid @enderror" name="price" required autofocus>
        </div>
        @error('price')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col py-2">
        <label for="" class="col-form-label ">{{ __('Classes item is compulsory for:') }}
          <small>(leave empty for all classes)</small>
        </label>
        <div class="row px-3">
          @foreach($classes as $class)
          <div class="col-md-4 p-1">
            <div class="card card-body">
              <input type="checkbox" id="classfor{{$loop->index}}" name="classfor[]" value="{{ $class->id ?? '' }}" />
              <label for="classfor{{$loop->index}}"> {{$class->name ?? ''}} </label>
              @error('classfor')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="col py-2">
        <label for="desc" class="col-form-label">{{ __('Description') }}</label>
        <textarea id="desc" class="flex-grow-1 form-control @error('desc') is-invalid @enderror" name="desc" required autofocus>{{$item->description ?? '' }}</textarea>
        @error('desc')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col d-flex gap-3 py-4">
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
@endsection