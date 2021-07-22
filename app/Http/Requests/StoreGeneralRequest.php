<?php

namespace App\Http\Requests;

use App\Models\General;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGeneralRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('general_create');
    }

    public function rules()
    {
        return [
            'admin_email' => [
                'string',
                'required',
            ],
            'timezone' => [
                'string',
                'nullable',
            ],
            'admin_title' => [
                'string',
                'required',
            ],
            'google_site_verification' => [
                'string',
                'nullable',
            ],
            'google_analytics' => [
                'string',
                'nullable',
            ],
            'analytics_view' => [
                'string',
                'nullable',
            ],
        ];
    }
}
