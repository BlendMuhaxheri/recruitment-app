@component('mail::message')

Hi {{ $application->candidate->first_name }},

We received your application for:

**{{ $application->job->title }}**

Our team will review it soon.

Thanks,
{{ $application->job->company->name }}
@endcomponent