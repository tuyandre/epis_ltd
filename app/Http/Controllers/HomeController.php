<?php

namespace App\Http\Controllers;

use App\Models\{Client, GalleryPhoto, Project, Service, TeamMember};

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'services' => Service::orderBy('sort_order')->get(),
            'team' => TeamMember::orderBy('sort_order')->get(),
            'projects' => Project::orderBy('sort_order')->get(),
            'clients' => Client::orderBy('sort_order')->get(),
            'gallery' => GalleryPhoto::orderBy('sort_order')->get(),
        ]);
    }
}
