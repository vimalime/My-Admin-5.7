<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public $table = 'facilities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function facilitiesProperties()
    {
        return $this->hasMany(Property::class, 'facilities_id', 'id');
    }

    public function facilitiesProjects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
