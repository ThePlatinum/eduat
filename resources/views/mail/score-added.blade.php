@component('mail::message')
# Introduction

<p>
  An accessment has been graded in {{$score->assessment->title}}, and your score is {{$score->score}}/{{$score->assessment->grade_point}}, that is {{($score->score / $score->assessment->grade_point) * 100}}%.
  Check to see if a remark was added by the teacher to help improve your performance.
</p>

@component('mail::button', ['url' => '{{config('app.url')}}'])
Check Here
@endcomponent

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