<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public const STATUS_SELECT = [
        'deactive' => 'deactive',
        'active'   => 'active',
    ];

    public $table = 'states';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'country_id',
        'order',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function stateCities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }

    public function stateUsers()
    {
        return $this->hasMany(User::class, 'state_id', 'id');
    }

    public function stateProjects()
    {
        return $this->hasMany(Project::class, 'state_id', 'id');
    }

    public function stateProperties()
    {
        return $this->hasMany(Property::class, 'state_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
