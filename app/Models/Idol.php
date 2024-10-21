<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idol extends Model
{
    use HasFactory;

    public function favorite_users()
    {
        return $this->belongsTo(User::class);
    }
}
