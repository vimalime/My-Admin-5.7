<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Blog extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasMediaTrait;
    use Auditable;

    public const STATUS_SELECT = [
        'draft'   => 'draft',
        'publish' => 'publish',
        'pending' => 'pending',
        'deleted' => 'deleted',
    ];

    public const FORMAT_SELECT = [
        'default' => 'default',
        'video'   => 'video',
        'photo'   => 'photo',
        'audio'   => 'audio',
        'gallery' => 'gallery',
    ];

    public $table = 'blogs';

    protected $appends = [
        'picture_image',
        'gallery_images',
    ];

    protected $dates = [
        'post_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'is_featured',
        'is_premium',
        'excerpt',
        'content',
        'blog_categories_id',
        'blog_tags_id',
        'post_date',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'template_id',
        'format',
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

    public function blogLinkReviews()
    {
        return $this->hasMany(Review::class, 'blog_link_id', 'id');
    }

    public function blogLinkSliders()
    {
        return $this->hasMany(Slider::class, 'blog_link_id', 'id');
    }

    public function blog_categories()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_categories_id');
    }

    public function blog_tags()
    {
        return $this->belongsTo(BlogTag::class, 'blog_tags_id');
    }

    public function getPostDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPostDateAttribute($value)
    {
        $this->attributes['post_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPictureImageAttribute()
    {
        $file = $this->getMedia('picture_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getGalleryImagesAttribute()
    {
        $files = $this->getMedia('gallery_images');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
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
