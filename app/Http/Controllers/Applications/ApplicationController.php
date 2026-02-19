<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\UpdateApplicationStageRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function updateStage(UpdateApplicationStageRequest $request, Application $application)
    {
        $this->authorize('update', $application);

        $application->update($request->validated());

        return back()->with('success', 'Stage updated.');
    }
}
