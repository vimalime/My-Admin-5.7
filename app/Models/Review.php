<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public $table = 'reviews';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'excerpt',
        'user_name',
        'email',
        'created_by_id',
        'page_link_id',
        'user_link_id',
        'product_link_id',
        'careers_link_id',
        'property_link_id',
        'project_link_id',
        'blog_link_id',
        'package_link_id',
        'investor_link_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function page_link()
    {
        return $this->belongsTo(Page::class, 'page_link_id');
    }

    public function user_link()
    {
        return $this->belongsTo(User::class, 'user_link_id');
    }

    public function product_link()
    {
        return $this->belongsTo(Product::class, 'product_link_id');
    }

    public function careers_link()
    {
        return $this->belongsTo(Career::class, 'careers_link_id');
    }

    public function property_link()
    {
        return $this->belongsTo(Property::class, 'property_link_id');
    }

    public function project_link()
    {
        return $this->belongsTo(Project::class, 'project_link_id');
    }

    public function blog_link()
    {
        return $this->belongsTo(Blog::class, 'blog_link_id');
    }

    public function package_link()
    {
        return $this->belongsTo(Package::class, 'package_link_id');
    }

    public function investor_link()
    {
        return $this->belongsTo(Investor::class, 'investor_link_id');
    }
}
