<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }


    public function departureStop()
    {
        return $this->belongsTo(Stop::class, 'departure_stop_id');
    }


    public function arrivalStop()
    {
        return $this->belongsTo(Stop::class, 'arrival_stop_id');
    }
}
