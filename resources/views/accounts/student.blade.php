@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5> Fees and Payments </h5>
  </div>

  <div class="p-3">

    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif

    <div class="row">
      <div class="col-8">
        <div class="card card-body">
          @role('Accountant')
          <h4>{{$student->fullname}}</h4>
          @endrole
          <h6 class="money">Total Dues: &#8358; {{$student->should_pay + $student->paid}}</h6>
          <h6 class="money">Total Paid: &#8358; {{$student->paid}}</h6>
          <h5 class="money">Outstanding: &#8358; {{$student->should_pay}}</h5>
        </div>
      </div>

      <div class="col-4">
        @role('Accountant')
        <div class="text-end">
          <a href=" {{ route('accounts') }} " class="btn btn-secondary btn-sm">
            <i class='fa fa-arrow-left'></i> <span>BACK</span>
          </a>
        </div>
        @endrole
      </div>
    </div>

    Fees
    <hr>
    <div class="row">
      @foreach ($per_classes as $per_class)
      <div class="col-md-4 pb-3 pr-3">
        <div class="card card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="m-0">{{$per_class['class']->name}}</h4>
            @php
            $currentclass = $student->klass_id == $per_class['class']->id;
            if ($currentclass) echo '<span class="pill">Current Class</span>';
            @endphp
          </div>
          <hr />
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Description</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ 1 }}</td>
                  <td> <strong>Tution Fee (all terms)</strong> </td>
                  <td class="d-flex justify-content-between">&#8358;<span class="money"> <strong>{{$per_class['class']->fees_sum}}</strong> </span> </td>
                  <td>
                </tr>
                <tr>
                  <td colspan="2">Selected Items</td>
                </tr>
                @forelse($per_class['items'] as $item)
                <tr>
                  <td>{{ $loop->index + 2 }}</td>
                  <td>{{$item->name ?? ''}}</td>
                  <td class="d-flex justify-content-between"> &#8358;<span class="money">{{$item->price ?? ''}}</span> </td>
                  <td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center">No other items selected while in this class</td>
                </tr>
                @endforelse

                <tr>
                  <td></td>
                  <td> <strong>TOTAL</strong> </td>
                  <td class="d-flex justify-content-between">&#8358;<span class="money"> <strong>{{$per_class['items_total'] + $per_class['class']->fees_sum}}</strong> </span> </td>
                  <td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="d-flex justify-content-between align-items-center">
      Payments
      @role('Accountant')
      <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addpayment">
        <i class='fa fa-add'></i> &nbsp; <span>New Payment</span>
      </a>
      <!-- Add Payment Modal -->
      <div class="modal fade" tabindex="-1" id="addpayment">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Payment for {{$student->fullname ?? ''}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form action="{{ route('addpayment') }}" method="POST">
                @csrf
                <input value="{{$student->klass_id ?? ''}}" name="class_id" hidden>
                <input value="{{$student->id ?? ''}}" name="student_id" hidden>

                <div class="col-12 py-2">
                  <label for="receipt_number" class="col-form-label ">{{ __('Receipt Number') }}</label>
                  <input id="receipt_number" type="text" class="form-control @error('receipt_number') is-invalid @enderror" name="receipt_number" autofocus>
                  @error('receipt_number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 py-2">
                  <label for="ammount" class="col-form-label ">{{ __('Ammount') }}</label>
                  <input id="ammount" type="number" min='0' class="form-control @error('ammount') is-invalid @enderror" name="ammount" required autofocus>
                  @error('ammount')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 py-2">
                  <label for="paydate" class="col-form-label ">{{ __('Paid on') }}</label>
                  <input id="paydate" type="date" class="form-control @error('paydate') is-invalid @enderror" name="paydate" required autofocus>
                  @error('paydate')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 py-2">
                  <label for="note" class="col-form-label ">{{ __('Note') }}</label>
                  <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" autofocus>
                  @error('note')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="modal-footer mt-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Payment</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Add Payment -->
      @endrole
    </div>
    <hr>
    <div class="row">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="bg-light">
              <th scope="col"></th>
              <th scope="col">Paid on</th>
              <th scope="col">While in class</th>
              <th scope="col">Ammout</th>
              <th scope="col">Receipt No.</th>
              <th scope="col">Payment Note</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($payments as $payment)
            <tr>
              <td>{{ $loop->index + 1 }}</td>
              <td>{{date_format($payment->paydate, 'D., d M, Y')}}</td>
              <td>{{$payment->class->name ?? 'Not provided'}}</td>
              <td class="d-flex justify-content-between"> &#8358;<span class="money pr-3">{{$payment->ammount ?? ''}}</span> </td>
              <td>{{$payment->receipt_number ?? 'Not provided'}}</td>
              <td>{{$payment->note ?? 'Not provided'}}</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">
                No payments made yet.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection