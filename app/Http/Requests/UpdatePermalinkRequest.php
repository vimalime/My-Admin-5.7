<?php

namespace App\Http\Requests;

use App\Models\Permalink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePermalinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('permalink_edit');
    }

    public function rules()
    {
        return [
            'pages' => [
                'string',
                'nullable',
            ],
            'blog_posts' => [
                'string',
                'nullable',
            ],
            'blog_categories' => [
                'string',
                'nullable',
            ],
            'blog_tags' => [
                'string',
                'nullable',
            ],
            'careers' => [
                'string',
                'nullable',
            ],
            'real_estate_properties' => [
                'string',
                'nullable',
            ],
            'real_estate_property_categories' => [
                'string',
                'nullable',
            ],
            'real_estate_projects' => [
                'string',
                'nullable',
            ],
        ];
    }
}
