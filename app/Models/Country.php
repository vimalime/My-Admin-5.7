<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public const STATUS_SELECT = [
        'deactive' => 'deactive',
        'active'   => 'active',
    ];

    public $table = 'countries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'short_code',
        'slug',
        'order',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function countryStates()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public function countryCities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    public function countryUsers()
    {
        return $this->hasMany(User::class, 'country_id', 'id');
    }

    public function countryProjects()
    {
        return $this->hasMany(Project::class, 'country_id', 'id');
    }

    public function countryProperties()
    {
        return $this->hasMany(Property::class, 'country_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
