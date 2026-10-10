<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;

class ServiceController extends ContentController
{
    protected function model(): string { return Service::class; }

    protected function slug(): string { return 'services'; }

    protected function label(): string { return 'Service'; }

    protected function fields(): array
    {
        return [
            'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:160'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'rules' => 'required|string|max:1000'],
            'icon' => ['label' => 'Icon', 'type' => 'select', 'options' => ['bolt' => 'Lightning', 'lines' => 'Power lines', 'clipboard' => 'Checklist'], 'rules' => 'required|in:bolt,lines,clipboard'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
        ];
    }
}

