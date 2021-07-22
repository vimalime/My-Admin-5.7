<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public const STATUS_SELECT = [
        'draft'   => 'draft',
        'pending' => 'pending',
        'publish' => 'publish',
        'deleted' => 'deleted',
    ];

    public $table = 'templates';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function templatePages()
    {
        return $this->hasMany(Page::class, 'template_id', 'id');
    }

    public function templateProductCategories()
    {
        return $this->hasMany(ProductCategory::class, 'template_id', 'id');
    }

    public function templateProductTags()
    {
        return $this->hasMany(ProductTag::class, 'template_id', 'id');
    }

    public function templateProducts()
    {
        return $this->hasMany(Product::class, 'template_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
