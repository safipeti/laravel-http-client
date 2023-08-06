<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Episode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'episode_character', 'episode_id', 'character_id');
    }


}
