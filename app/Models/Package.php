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

class Package extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasMediaTrait;
    use Auditable;

    public const CURRENCY_SELECT = [
        'usd' => 'USD',
        'inr' => 'INR',
    ];

    public const POST_STATUS_SELECT = [
        'draft'   => 'draft',
        'publish' => 'publish',
        'pending' => 'pending',
        'deleted' => 'deleted',
    ];

    public $table = 'packages';

    protected $dates = [
        'publish_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'except',
        'content',
        'is_featured',
        'is_premium',
        'price',
        'post_status',
        'currency',
        'order',
        'percent_save',
        'number_of_listings',
        'limit_purchase_by_account',
        'is_default',
        'publish_date',
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

    public function packageLinkReviews()
    {
        return $this->hasMany(Review::class, 'package_link_id', 'id');
    }

    public function packageLinkSliders()
    {
        return $this->hasMany(Slider::class, 'package_link_id', 'id');
    }

    public function getPublishDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPublishDateAttribute($value)
    {
        $this->attributes['publish_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
