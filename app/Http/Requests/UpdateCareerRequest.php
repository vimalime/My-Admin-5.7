<?php

namespace App\Http\Requests;

use App\Models\Career;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCareerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('career_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:careers,slug,' . request()->route('career')->id,
            ],
            'publish_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'location' => [
                'string',
                'nullable',
            ],
            'salary' => [
                'string',
                'nullable',
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
