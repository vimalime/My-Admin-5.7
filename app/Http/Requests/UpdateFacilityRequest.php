<?php

namespace App\Http\Requests;

use App\Models\Facility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFacilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facility_edit');
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
                'unique:facilities,slug,' . request()->route('facility')->id,
            ],
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
