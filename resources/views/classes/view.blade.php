@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row header bg-light p-3">
    <h5>View Class</h5>
  </div>

  <div class="page p-3 flex-grow-1">
    <div class="text-end">
      <a href=" {{ route('classes') }} " class="btn btn-secondary btn-sm">
        <i class='bx bx-arrow-back'></i> <span>BACK</span>
      </a>
    </div>

    <div class="row py-3">
      <div class="col-md-6">
        <h3> JS 1 </h3>
        Class Teacher: <span>Jhon Edy</span>
      </div>
      <div class="col-md-6 p-3">
        Subjects
        <hr>
        <div class="row">
          @forelse(['Mathematics', 'English', 'Yoruba'] as $subjects)
          <div class="col-6 p-2">
            <div class="subjectlist">{{$subjects}}</div>
          </div>
          @empty
          <p class="text-center p-5">No Subjects added yet.</p>
          @endforelse
        </div>
      </div>
      <div class="py-3">
        Students
        <hr />
        <table class="table">
          <tr class="bg-light">
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
            @forelse(['Seyi Baby', 'Ewami', 'John Doe', 'Olubisi S John', 'Mum Abigial'] as $student)
            <tr>
              <td></td>
              <td> {{$student}} </td>
              <td> studentemail@schol.com </td>
              <td> 09023781983 </td>
              <td>
                <a href="{{ route('viewprofile') }}" class="btn btn-primary btn-sm">
                  <i class='bx bx-show'></i></a>
              </td>
            </tr>
            @empty
            <p class="text-center p-5">No students registered in the class yet.</p>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection