<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;

class ProjectController extends ContentController
{
    protected function model(): string { return Project::class; }

    protected function slug(): string { return 'projects'; }

    protected function label(): string { return 'Project'; }

    protected function fields(): array
    {
        return [
            'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:160'],
            'partner' => ['label' => 'Partner label (e.g. With CGCOC Group)', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
            'description' => ['label' => 'Description', 'type' => 'textarea', 'rules' => 'nullable|string|max:1000'],
            'image' => ['label' => 'Photo', 'type' => 'image', 'rules' => 'nullable|image|max:6144'],
            'size' => ['label' => 'Card width', 'type' => 'select', 'options' => ['wide' => 'Wide (4/6)', 'mid' => 'Half (3/6)', 'narrow' => 'Narrow (2/6)'], 'rules' => 'required|in:wide,mid,narrow'],
            'gradient' => ['label' => 'Fallback background (CSS)', 'type' => 'text', 'rules' => 'required|string|max:200'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
        ];
    }
}

