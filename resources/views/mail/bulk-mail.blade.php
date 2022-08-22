@component('mail::message')
# {{$bulkmail->subject}}

<p>{{$bulkmail->content}}</p>


<br>
<br>
<p>
  Regards,<br>
  {{config('app.name')}}
</p>


<br>
<hr>
Powered by <a href="https://emmannueldesina.vercel.app">Platinum Innovations</a>
@endcomponent