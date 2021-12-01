<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class OrganisationPersonnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'organisation_id',
        'name',
        'title',
        'vehicle_no',
        'type_of_vehicle',
        'nin',
        'status',
        'phone_no',
        'users_id',
        'occupants',
        'reason_for_rejection',
        'date_of_approval',
        'validity',
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate();
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
}
