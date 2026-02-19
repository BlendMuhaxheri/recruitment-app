<?php

namespace App\Http\Controllers\Candidates;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $applications = Application::query()
            ->whereHas(
                'candidate',
                fn($query) =>
                [
                    $query->where('company_id', auth()->id())
                ]
            )
            ->with(['candidate', 'job'])
            ->latest()
            ->get();

        return view('company.candidates.index', [
            'applications' => $applications
        ]);
    }
}
