@component('mail::message')
# {{$bulkmail->subject}}

{{$bulkmail->content}}

From,<br>
{{ config('app.name') }}
@endcomponent
