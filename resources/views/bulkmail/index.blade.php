@extends('bulkmail.bulkmail')

@section('bulkmail')

<div class="px-2 px-md-3">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-body flex-row justify-content-between align-items-center">
        <h4 class='p-0 m-0'>{{count($sentmails)}} Mails Sent</h4>
        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-mail">New Mail</a>
      </div>

      <!-- Start Mail Modal "-->
      <div class="modal fade" tabindex="-1" id="new-mail" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Send New Mail</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('sendbulkmail')}}" method="POST">
              @csrf
              <div class="modal-body">

                <div class="col-12 py-1">
                  <label for="to" class="col-form-label">{{__('Send to')}}</label>
                  <select id="to" name="to" required autofocus class="form-control @error('to') is-invalid @enderror" @role('Teacher') readonly @endrole>
                    @role('Admin|Accountant')
                    <option value="">Select Option</option>
                    <option value="all_students">All Students</option>
                    @endrole
                    @role('Admin')
                    <option value="all_teachers">All Teachers</option>
                    <option value="all_staffs">All Staffs</option>
                    <option value="all">Everyone</option>
                    @endrole
                    @role('Accountant')
                    <option value="defaulters">All Defaulters</option>
                    <option value="non_defaulters">All Non-Defaulters</option>
                    @endrole
                    <option value="students_in">Students in class</option>
                  </select>
                  @error('to')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 py-1 class_id">
                  <label for="class_id" class="col-form-label">{{__('Select Class')}}</label>
                  <select id="class_id" name="class_id" autofocus class="form-control @error('class_id') is-invalid @enderror" @role('Teacher') required @endrole>
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                    <option value="{{$class->id}}">{{$class->name }}</option>
                    @endforeach
                  </select>
                  @error('class_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 py-1">
                  <label for="subject" class="col-form-label">{{__('Subject')}}</label>
                  <input id="subject" required autofocus value="{{old('subject')}}" name="subject" class="form-control @error('subject') is-invalid @enderror">
                  @error('subject')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 py-1">
                  <label for="content" class="col-form-label">{{__('Content')}}</label>
                  <textarea required autofocus id="content" placeholder="The content of the mail" class="form-control @error('content') is-invalid @enderror" name="content" rows="5">{{old('content')}}</textarea>
                  @error('content')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>

              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger px-5">Send Mail</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Mail Modal -->
    </div>
  </div>
  <div class="">
    <hr>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr class="bg-light">
            <th scope="col">SN</th>
            <th scope="col">Subject</th>
            <th scope="col">Mail Content</th>
            @role('Admin')
            <th scope="col">Sent By</th>
            @endrole
            <th scope="col">To</th>
            <th scope="col">When</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($sentmails as $sentmail)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$sentmail->subject}}</td>
            <td>{{$sentmail->content}}</td>
            @role('Admin')
            <td>
              {{$sentmail->user->fullname}} <br>
              ({{$sentmail->user->roles[0]->name}})
            </td>
            @endrole
            <td class='text-capitalize'>
              @if($sentmail->to == 'students_in')
              {{$sentmail->class->name}}
              @else
              {{str_replace('_', ' ', $sentmail->to)}}
              @endif
            </td>
            <td>{{date_format($sentmail->created_at, 'D, d-M-Y')}} <br> ({{ $sentmail->created_at->diffForHumans() }}) </td>
            <td>
              <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="{{'#template-mail'.$sentmail->id}}">Use as Template</a>
            </td>

            <!-- Start Mail Modal "-->
            <div class="modal fade" tabindex="-1" id="{{'template-mail'.$sentmail->id}}" data-bs-backdrop="static" data-bs-keyboard="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Send New Mail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('sendbulkmail')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                      <div class="col-12 py-1">
                        <label for="to" class="col-form-label">{{__('Send to')}}</label>
                        <select id="to_loops" name="to" required autofocus class="form-control @error('to') is-invalid @enderror to_loop" @role('Teacher') readonly @endrole>
                          @role('Admin')
                          <option value="">Select Option</option>
                          <option value="all">Everyone</option>
                          <option value="all_teachers">All Teachers</option>
                          <option value="all_students">All Students</option>
                          @endrole
                          <option value="students_in">Students in class</option>
                        </select>
                        @error('to')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="col-12 py-1 class_id">
                        <label for="class_id" class="col-form-label">{{__('Select Class')}}</label>
                        <select id="class_id" name="class_id" autofocus class="form-control @error('class_id') is-invalid @enderror" @role('Teacher') required @endrole>
                          <option value="">Select Class</option>
                          @foreach ($classes as $class)
                          <option value="{{$class->id}}">{{$class->name }}</option>
                          @endforeach
                        </select>
                        @error('class_id')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="col-12 py-1">
                        <label for="subject" class="col-form-label">{{__('Subject')}}</label>
                        <input id="subject" required autofocus value="{{$sentmail->subject}}" name="subject" class="form-control @error('subject') is-invalid @enderror">
                        @error('subject')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                      </div>

                      <div class="col-12 py-1">
                        <label for="content" class="col-form-label">{{__('Content')}}</label>
                        <textarea required autofocus id="content" placeholder="The content of the mail" class="form-control @error('content') is-invalid @enderror" name="content" rows="5">{{$sentmail->content}}</textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger px-5">Send Mail</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Mail Modal -->
          </tr>
          @empty
          <tr>
            <td colspan="@role('Admin') 7 @else 6 @endrole" class="text-center p-5">No mails has been sent.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  let pickedTo = document.getElementById("to");
  let class_id = document.querySelectorAll(".class_id")

  let toLoop = document.querySelectorAll(".to_loop")
  toLoop.forEach(o => o.addEventListener('change', () => {
    let picked = o.options[o.selectedIndex].value;
    class_id.forEach(p => p.style.display = "none")
    if (picked == 'students_in') {
      class_id.forEach(p => p.style.display = "block")
    }
  }))

  pickedTo.addEventListener('change', () => selects())

  function selects() {
    let to = pickedTo.options[pickedTo.selectedIndex].value;
    class_id.forEach(o => o.style.display = "none")
    if (to == 'students_in') {
      class_id.forEach(o => o.style.display = "block")
    }
  }
  selects()
</script>
@endsection