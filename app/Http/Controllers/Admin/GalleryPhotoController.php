<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryPhoto;

class GalleryPhotoController extends ContentController
{
    protected function model(): string { return GalleryPhoto::class; }

    protected function slug(): string { return 'gallery'; }

    protected function label(): string { return 'Gallery photo'; }

    protected function fields(): array
    {
        return [
            'caption' => ['label' => 'Caption', 'type' => 'text', 'rules' => 'required|string|max:160'],
            'image' => ['label' => 'Photo', 'type' => 'image', 'rules' => 'nullable|image|max:8192'],
            'sort_order' => ['label' => 'Display order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
        ];
    }
}
