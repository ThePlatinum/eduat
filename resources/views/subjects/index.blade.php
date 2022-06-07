@extends('subjects.subject')

@section('subject')
<div class="text-end">
  <a href=" {{ url()->previous() }} " class="btn btn-secondary btn-sm">
    <i class='bx bx-arrow-back'></i> <span>BACK</span>
  </a>
</div>

<div class="bg-light p-3">
</div>
@endsection