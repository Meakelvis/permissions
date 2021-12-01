<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_name',
        'title',
        'date_of_application',
        'address',
        'purpose_of_travel',
        'no_of_vehicles',
        'from',
        'to',
        'validity',
        'valid_from',
        'valid_to',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
