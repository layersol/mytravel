<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $guarded = [];
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
