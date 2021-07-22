<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Slider extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasMediaTrait;
    use Auditable;

    public $table = 'sliders';

    protected $appends = [
        'slider_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'title_1',
        'title_2',
        'excerpt',
        'page_link_id',
        'product_link_id',
        'careers_link_id',
        'property_link_id',
        'project_link_id',
        'blog_link_id',
        'package_link_id',
        'investor_link_id',
        'link',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function page_link()
    {
        return $this->belongsTo(Page::class, 'page_link_id');
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

    public function getSliderImageAttribute()
    {
        $file = $this->getMedia('slider_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
