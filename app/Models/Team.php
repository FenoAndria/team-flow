<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = ['name', 'lead_id'];

    public function lead(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function member(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
