<?php

namespace App\Http\Controllers\Companies;

use App\Events\InterviewScheduled;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\StoreInterviewRequest;
use App\Models\ActivityLog;
use App\Models\Application;
use App\Models\Interview;
use App\Services\Companies\SubmitInterview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public SubmitInterview $service;

    public function __construct(SubmitInterview $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $interviews = Interview::query()
            ->with(['application.candidate', 'application.job'])
            ->orderBy('scheduled_at')
            ->paginate();

        return view('company.interviews.index', ['interviews' => $interviews]);
    }

    public function create(Application $application)
    {
        return view('company.interviews.create', ['application' => $application]);
    }

    public function store(StoreInterviewRequest $request, Application $application)
    {
        $this->service->submit($request->validated(), $application,  $request->user()->company_id);

        return redirect()->route('company.candidates.show', $application->candidate);
    }
}
