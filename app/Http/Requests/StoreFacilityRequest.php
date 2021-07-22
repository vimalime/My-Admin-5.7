<?php

namespace App\Http\Requests;

use App\Models\Facility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFacilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facility_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:facilities',
            ],
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
