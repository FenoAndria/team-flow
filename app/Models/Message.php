<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    protected $table = 'team_messages';
    protected $fillable = ['sender_id', 'team_id', 'content'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
