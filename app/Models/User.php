<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes;
    use Notifiable;
    use HasApiTokens;
    use HasMediaTrait;
    use Auditable;

    public const GENDER_RADIO = [
        'male'   => 'male',
        'female' => 'female',
    ];

    public const STATUS_SELECT = [
        'draft'   => 'draft',
        'pending' => 'pending',
        'publish' => 'publish',
        'deleted' => 'deleted',
    ];

    public $table = 'users';

    protected $hidden = [
        'remember_token', 'two_factor_code',
        'password',
    ];

    protected $appends = [
        'picture_image',
        'gallery_images',
        'id_proof',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'two_factor',
        'approved',
        'two_factor_code',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'first_name',
        'last_name',
        'username',
        'gender',
        'phone',
        'is_featured',
        'credits',
        'status',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'pin_code',
        'qualification',
        'exprience',
        'about_us',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');
                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function createdByTemplates()
    {
        return $this->hasMany(Template::class, 'created_by_id', 'id');
    }

    public function createdByPages()
    {
        return $this->hasMany(Page::class, 'created_by_id', 'id');
    }

    public function createdByProductCategories()
    {
        return $this->hasMany(ProductCategory::class, 'created_by_id', 'id');
    }

    public function createdByProductTags()
    {
        return $this->hasMany(ProductTag::class, 'created_by_id', 'id');
    }

    public function createdByProducts()
    {
        return $this->hasMany(Product::class, 'created_by_id', 'id');
    }

    public function createdByCareers()
    {
        return $this->hasMany(Career::class, 'created_by_id', 'id');
    }

    public function createdByPropertyFeatures()
    {
        return $this->hasMany(PropertyFeature::class, 'created_by_id', 'id');
    }

    public function createdByInvestors()
    {
        return $this->hasMany(Investor::class, 'created_by_id', 'id');
    }

    public function createdByProjects()
    {
        return $this->hasMany(Project::class, 'created_by_id', 'id');
    }

    public function createdByProperties()
    {
        return $this->hasMany(Property::class, 'created_by_id', 'id');
    }

    public function authorProperties()
    {
        return $this->hasMany(Property::class, 'author_id', 'id');
    }

    public function createdByBlogs()
    {
        return $this->hasMany(Blog::class, 'created_by_id', 'id');
    }

    public function createdByPackages()
    {
        return $this->hasMany(Package::class, 'created_by_id', 'id');
    }

    public function createdByContacts()
    {
        return $this->hasMany(Contact::class, 'created_by_id', 'id');
    }

    public function createdByFaqCategories()
    {
        return $this->hasMany(FaqCategory::class, 'created_by_id', 'id');
    }

    public function createdByFaqQuestions()
    {
        return $this->hasMany(FaqQuestion::class, 'created_by_id', 'id');
    }

    public function createdByReviews()
    {
        return $this->hasMany(Review::class, 'created_by_id', 'id');
    }

    public function userLinkReviews()
    {
        return $this->hasMany(Review::class, 'user_link_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
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

    public function getIdProofAttribute()
    {
        $files = $this->getMedia('id_proof');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
