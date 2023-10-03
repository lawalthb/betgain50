<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',  
        'email', 
        'phone',
        'amount',
        'callback_url',
            'gateway_response',
            'paid_at',
            'authorization_url',
            'authorization_code',
            'status',
            'user_id',
            
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }
}
