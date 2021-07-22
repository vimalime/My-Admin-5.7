<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends Model
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

    public $table = 'blog_tags';

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
        'author_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function blogTagsBlogs()
    {
        return $this->hasMany(Blog::class, 'blog_tags_id', 'id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
