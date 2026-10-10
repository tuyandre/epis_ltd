<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;

class ClientController extends ContentController
{
    protected function model(): string { return Client::class; }

    protected function slug(): string { return 'clients'; }

    protected function label(): string { return 'Client'; }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Name', 'type' => 'text', 'rules' => 'required|string|max:120'],
            'subtitle' => ['label' => 'Subtitle', 'type' => 'text', 'rules' => 'nullable|string|max:160'],
            'logo' => ['label' => 'Logo', 'type' => 'image', 'rules' => 'nullable|image|max:2048'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
        ];
    }
}

