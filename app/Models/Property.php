<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Property extends Model implements HasMedia
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

    public const MODERATION_STATUS_SELECT = [
        'pending'  => 'pending',
        'approved' => 'approved',
        'rejected' => 'rejected',
    ];

    public const STATUS_SELECT = [
        'draft'   => 'draft',
        'pending' => 'pending',
        'publish' => 'publish',
        'deleted' => 'deleted',
    ];

    public const SELLING_STATUS_SELECT = [
        'not_available'     => 'Not Available',
        'preparing_selling' => 'Preparing selling',
        'selling'           => 'Selling',
        'sold'              => 'Sold',
        'renting'           => 'Renting',
        'rented'            => 'Rented',
        'building'          => 'Building',
    ];

    public $table = 'properties';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'picture_image',
        'gallery_images',
        'video_thumb',
    ];

    protected $fillable = [
        'title',
        'slug',
        'is_featured',
        'is_premium',
        'except',
        'content',
        'type',
        'country_id',
        'state_id',
        'city_id',
        'property_location',
        'latitude',
        'longitude',
        'number_bedrooms',
        'number_bathrooms',
        'number_floors',
        'square',
        'price',
        'currency',
        'period',
        'never_expired',
        'video_url',
        'property_type_id',
        'property_features_id',
        'facilities_id',
        'distance_between_facilities',
        'moderation_status',
        'status',
        'selling_status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_at',
        'project_id',
        'author_id',
        'created_by_id',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function propertyLinkReviews()
    {
        return $this->hasMany(Review::class, 'property_link_id', 'id');
    }

    public function propertyLinkSliders()
    {
        return $this->hasMany(Slider::class, 'property_link_id', 'id');
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

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function property_features()
    {
        return $this->belongsTo(PropertyFeature::class, 'property_features_id');
    }

    public function facilities()
    {
        return $this->belongsTo(Facility::class, 'facilities_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
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
