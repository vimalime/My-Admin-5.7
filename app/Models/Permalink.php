<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permalink extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'permalinks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pages',
        'blog_posts',
        'blog_categories',
        'blog_tags',
        'careers',
        'real_estate_properties',
        'real_estate_property_categories',
        'real_estate_projects',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
