<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['message'];
    protected $appends=['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($val)
{
    return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
    
}
}
