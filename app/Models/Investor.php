<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investor extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;

    public const STATUS_SELECT = [
        'draft'   => 'draft',
        'publish' => 'publish',
        'deleted' => 'deleted',
        'pending' => 'pending',
    ];

    public $table = 'investors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function investorLinkReviews()
    {
        return $this->hasMany(Review::class, 'investor_link_id', 'id');
    }

    public function investorLinkSliders()
    {
        return $this->hasMany(Slider::class, 'investor_link_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
