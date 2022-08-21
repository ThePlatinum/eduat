@component('mail::message')
# Introduction

An accessment has been graded in {{$score->assessment->title}}, and your score is {{$score->score}}/{{$score->assessment->grade_point}}, that is {{($score->score / $score->assessment->grade_point) * 100}}%.
Check to see if a remark was added by the teacher to help improve your performance.

@component('mail::button', ['url' => '{{config('app.url')}}'])
Check Here
@endcomponent

<br>
<br>
Regards,<br>
{{config('app.name')}}

<br>
<br>
<hr>
<p>Powered by <a href="https://emmannueldesina.vercel.app">Platinum Innovations</a></p>
@endcomponent