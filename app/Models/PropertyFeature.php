<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyFeature extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public $table = 'property_features';

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

    public function propertyFeaturesProjects()
    {
        return $this->hasMany(Project::class, 'property_features_id', 'id');
    }

    public function propertyFeaturesProperties()
    {
        return $this->hasMany(Property::class, 'property_features_id', 'id');
    }

    public function featuresProjects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
