@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5> Your Fees and Payments </h5>
  </div>

  <div class="p-3">
    Fees
    <hr>
    <div class="row">
    @foreach ($per_classes as $per_class)
    <div class="col-md-4 pb-3 pr-3">
      <div class="card card-body">
        <div class="d-flex justify-content-between align-items-center">
          @php
            $currentclass = $loop->index + 1 == sizeof($per_classes)
          @endphp
          <h4 class="m-0"> {{$per_class['class']->name}} </h4>
          <span class="pill"> {{$currentclass ? 'Current Class' : '' }} </span>
        </div>
        <hr />
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th scope="col"></th>
              <th scope="col">Description</th>
              <th scope="col">Amount</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td> <strong>Tution Fee (all terms)</strong> </td>
                <td> <strong> &#8358;{{$per_class['tution']}} </strong> </td>
                <td>
              </tr>
              <tr>
                <td colspan="2">Selected Items</td>
              </tr>
              @forelse($per_class['items'] as $item)
              <tr>
                <td>{{ $loop->index + 2 }}</td>
                <td> {{$item->name ?? ''}} </td>
                <td> &#8358;{{$item->price ?? ''}} </td>
                <td>
              </tr>
              @empty
              <p class="text-center p-5">No other items selected. <br> Go to the <b>Items</b> menu to select some. </p>
              @endforelse

              <tr>
                <td></td>
                <td> <strong>TOTAL</strong> </td>
                <td> <strong>&#8358;{{$per_class['itemtotal'] + $per_class['tution']}} </strong> </td>
                <td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endforeach
    </div>

    Payments
    <hr>
    <div class="row">
    @forelse ([] as $payment)
      
    @empty
      <div class="text-center">
        No payments made yet.
      </div>
    @endforelse

    </div>
  </div>
</div>
@endsection