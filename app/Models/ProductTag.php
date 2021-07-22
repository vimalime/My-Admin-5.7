<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTag extends Model
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

    public $table = 'product_tags';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'status',
        'template_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function tagProducts()
    {
        return $this->belongsToMany(Product::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
