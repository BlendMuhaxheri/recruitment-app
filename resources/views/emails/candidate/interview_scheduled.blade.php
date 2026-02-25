@component('mail::message')

Hi {{ $interview->application->candidate->first_name ?? $interview->application->candidate->name ?? 'there' }},

Your interview has been scheduled.

@component('mail::panel')
**Date:** {{ optional($interview->scheduled_at)->format('d M Y') ?? ($interview->date ?? '—') }}
**Time:** {{ optional($interview->scheduled_at)->format('H:i') ?? ($interview->time ?? '—') }}
**Type:** {{ $interview->type ?? '—' }}
**Location / Link:** {{ $interview->location ?? ($interview->meeting_link ?? '—') }}
@endcomponent

If you have any questions, just reply to this email.

Thanks,
{{ config('app.name') }}
@endcomponent