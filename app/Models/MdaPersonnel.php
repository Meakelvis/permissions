<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdaPersonnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'mda_id',
        'name',
        'title',
        'vehicle_no',
        'nin',
    ];
}
