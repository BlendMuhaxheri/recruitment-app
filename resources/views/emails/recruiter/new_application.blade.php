@component('mail::message')

A new candidate applied:

**{{ $application->candidate->full_name }}**

Job: **{{ $application->job->title }}**

@component('mail::button', ['url' => url('/dashboard/candidates/'.$application->id)])
View Candidate
@endcomponent

@endcomponent