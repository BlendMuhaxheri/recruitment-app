<?php

namespace App\Http\Controllers\Companies;

use App\Events\InterviewScheduled;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\StoreInterviewRequest;
use App\Models\ActivityLog;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index() {}

    public function create(Application $application)
    {
        return view('company.interviews.create', ['application' => $application]);
    }

    public function store(StoreInterviewRequest $request, Application $application)
    {
        $validated = $request->validated();

        $interview = Interview::create([
            ...$validated,
            'company_id'     => $request->user()->company_id,
            'application_id' => $application->id,

        ]);

        event(new InterviewScheduled($interview));

        return redirect()->route('company.candidates.show', $application->candidate);
    }
}
