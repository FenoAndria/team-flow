<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamNotification extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'user_id', 'type', 'data', 'read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
