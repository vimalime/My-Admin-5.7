<?php

namespace App\Http\Requests;

use App\Models\Email;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('email_edit');
    }

    public function rules()
    {
        return [
            'email_driver' => [
                'string',
                'nullable',
            ],
            'email_mail_gun_domain' => [
                'string',
                'nullable',
            ],
            'email_mail_gun_endpoint' => [
                'string',
                'nullable',
            ],
            'email_from_name' => [
                'string',
                'nullable',
            ],
            'email_from_address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
