<?php

namespace App\Http\Requests;

use App\Models\Slider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'title_2' => [
                'string',
                'nullable',
            ],
            'excerpt' => [
                'string',
                'nullable',
            ],
            'slider_image' => [
                'required',
            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
