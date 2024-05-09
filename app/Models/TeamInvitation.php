<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamInvitation extends Model
{
    use HasFactory;
    protected $table = 'team_invitations';
    protected $fillable = ['team_id', 'user_id', 'status'];
}
