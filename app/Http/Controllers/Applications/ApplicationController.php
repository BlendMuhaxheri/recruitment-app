<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\UpdateApplicationStageRequest;
use App\Models\ActivityLog;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function updateStage(UpdateApplicationStageRequest $request, Application $application)
    {
        $this->authorize('update', $application);

        $application->update($request->validated());

        ActivityLog::create([
            'company_id'   => auth()->user()->id,
            'candidate_id' => $application->candidate_id,
            'action'       => "Stage changed to " . ucfirst($request->application_stage)
        ]);

        return back()->with('success', 'Stage updated.');
    }
}
