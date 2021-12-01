<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mda extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity',
        'applicant_on_behalf',
        'title',
        'address',
        'category',
        'purpose',
        'phone',
        'no_of_workers'
    ];
}
