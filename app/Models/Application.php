<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;


class Application extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'title',
        'from',
        'to',
        'date_of_application',
        'purpose',
        'valid_from',
        'valid_to',
        'status',
        'date_of_approval',
        'users_id', // approved/rejected by
        'created_by',
        'phone_number'
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class)->withPivot(['vehicle_no']);
    }

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
}
