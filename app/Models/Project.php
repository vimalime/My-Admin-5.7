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

class Project extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasMediaTrait;
    use Auditable;

    public const CURRENCY_SELECT = [
        'inr' => 'inr',
        'usd' => 'usd',
    ];

    public const TYPE_SELECT = [
        'rent' => 'rent',
        'sale' => 'sale',
        'buy'  => 'buy',
    ];

    public const PERIOD_SELECT = [
        'month' => 'month',
        'year'  => 'year',
        'day'   => 'day',
    ];

    public $table = 'projects';

    protected $appends = [
        'picture_image',
        'gallery_images',
        'video_thumb',
    ];

    protected $dates = [
        'finish_date',
        'open_sell_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'type',
        'is_featured',
        'is_premium',
        'except',
        'content',
        'country_id',
        'state_id',
        'city_id',
        'property_location',
        'latitude',
        'longitude',
        'price',
        'period',
        'never_expired',
        'video_url',
        'property_features_id',
        'property_type_id',
        'distance_between_facilities',
        'number_blocks',
        'number_floors',
        'number_flats',
        'lowest_price',
        'currency',
        'max_price',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'investors_id',
        'finish_date',
        'open_sell_date',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function projectProperties()
    {
        return $this->hasMany(Property::class, 'project_id', 'id');
    }

    public function projectLinkReviews()
    {
        return $this->hasMany(Review::class, 'project_link_id', 'id');
    }

    public function projectLinkSliders()
    {
        return $this->hasMany(Slider::class, 'project_link_id', 'id');
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getVideoThumbAttribute()
    {
        $file = $this->getMedia('video_thumb')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function property_features()
    {
        return $this->belongsTo(PropertyFeature::class, 'property_features_id');
    }

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function investors()
    {
        return $this->belongsTo(Investor::class, 'investors_id');
    }

    public function getFinishDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setFinishDateAttribute($value)
    {
        $this->attributes['finish_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getOpenSellDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setOpenSellDateAttribute($value)
    {
        $this->attributes['open_sell_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
