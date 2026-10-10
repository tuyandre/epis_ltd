<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamMember;

class TeamMemberController extends ContentController
{
    protected function model(): string { return TeamMember::class; }

    protected function slug(): string { return 'team'; }

    protected function label(): string { return 'Team member'; }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Name', 'type' => 'text', 'rules' => 'required|string|max:120'],
            'role' => ['label' => 'Role', 'type' => 'text', 'rules' => 'required|string|max:120'],
            'photo' => ['label' => 'Photo', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
        ];
    }
}

