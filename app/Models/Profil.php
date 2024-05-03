<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';
    protected $fillable = ['name', 'birth_date', 'gender', 'bio', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
