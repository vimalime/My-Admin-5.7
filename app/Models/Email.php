<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'emails';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email_driver',
        'email_mail_gun_domain',
        'email_mail_gun_endpoint',
        'email_from_name',
        'email_from_address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
