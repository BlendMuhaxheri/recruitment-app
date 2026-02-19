<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;

class DashboardController extends Controller
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

        return view('company.dashboard', ['applications' => $applications]);
    }
}
