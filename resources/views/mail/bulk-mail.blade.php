@component('mail::message')
# {{$bulkmail->subject}}

{{$bulkmail->content}}

<br>
<br>
Regards,<br>
{{ config('app.name') }}

<br>
<br>
<hr>
<p>Powered by <a href="https://emmannueldesina.vercel.app">Platinum Innovations</a></p>
@endcomponent