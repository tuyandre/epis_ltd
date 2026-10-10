<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Client, Project, QuoteRequest, Service, TeamMember};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'New quotes' => QuoteRequest::where('status', 'new')->count(),
                'Services' => Service::count(),
                'Team' => TeamMember::count(),
                'Projects' => Project::count(),
                'Clients' => Client::count(),
            ],
            'latest' => QuoteRequest::latest()->take(5)->get(),
        ]);
    }
}
