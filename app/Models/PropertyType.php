<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyType extends Model
{
    use SoftDeletes;

    public const STATUS_SELECT = [
        'draft'   => 'draft',
        'publish' => 'publish',
        'deleted' => 'deleted',
        'pending' => 'pending',
    ];

    public $table = 'property_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function propertyTypeProjects()
    {
        return $this->hasMany(Project::class, 'property_type_id', 'id');
    }

    public function propertyTypeProperties()
    {
        return $this->hasMany(Property::class, 'property_type_id', 'id');
    }
}
