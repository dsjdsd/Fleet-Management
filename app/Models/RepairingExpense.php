<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairingExpense extends Model
{
    use HasFactory;

    public function vehicle(){
        return $this->belongsTo(vehicle::class, 'vehicle_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'driver_id');
    }
}
