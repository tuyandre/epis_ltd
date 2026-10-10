<?php

namespace App\Support;

class Media
{
    /** Bundled photos live under public/images; uploads live on the public disk. */
    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return str_starts_with($path, 'images/') ? asset($path) : asset('storage/'.$path);
    }
}
