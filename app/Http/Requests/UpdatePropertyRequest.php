<?php

namespace App\Http\Requests;

use App\Models\Property;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('property_edit');
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
                'unique:properties,slug,' . request()->route('property')->id,
            ],
            'type' => [
                'required',
            ],
            'property_location' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'number_bedrooms' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'number_bathrooms' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'number_floors' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'square' => [
                'numeric',
            ],
            'video_url' => [
                'string',
                'nullable',
            ],
            'distance_between_facilities' => [
                'string',
                'nullable',
            ],
            'moderation_status' => [
                'required',
            ],
            'status' => [
                'required',
            ],
            'meta_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
