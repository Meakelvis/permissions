<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'category',
        'entity',
        'name_of_applicant',
        'title',
        'address',
        'phone_no',
        'total_no_of_workers',
        'created_by',
        'email',
        'password',
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

    public function organisationPersonnel()
    {
        return $this->hasMany(OrganisationPersonnel::class);
    }
}
