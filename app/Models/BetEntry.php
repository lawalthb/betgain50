<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'bet_amount',
        'bet_crash',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
