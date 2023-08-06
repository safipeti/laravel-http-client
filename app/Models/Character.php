<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function episodes(): BelongsToMany
    {
        //return $this->belongsToMany(Character::class, 'episode_character', 'episode_id', 'character_id');
        return $this->belongsToMany(Character::class, 'episode_character', 'character_id', 'episode_id');
    }

    public function origin(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
