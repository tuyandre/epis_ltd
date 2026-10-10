<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $guarded = [];

    public function getInitialsAttribute(): string
    {
        return collect(explode(' ', $this->name))->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('');
    }}
