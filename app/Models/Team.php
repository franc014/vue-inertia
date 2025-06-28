<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    public function teamMembers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TeamMember::class);
    }
}
