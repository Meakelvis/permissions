<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_name',
        'occupant_name',
        'motor_vehicle_no',
        'driver_name',
    ];
}
