<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const IS_SUPER = 1; // super user
    public const IS_ADMIN = 2; // administrator
    public const IS_GENERAL = 3; // general user
    public const IS_ORG = 4; // organisation
    public const IS_REVERT = 5; // Revert
    public const IS_APPROVAL = 6; // Approval

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
