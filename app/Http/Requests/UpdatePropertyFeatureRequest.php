<?php

namespace App\Http\Requests;

use App\Models\PropertyFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePropertyFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('property_feature_edit');
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
                'unique:property_features,slug,' . request()->route('property_feature')->id,
            ],
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
