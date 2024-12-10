<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $table = 'passengers';
    protected $guarded = [];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    
}
