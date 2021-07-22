<?php

namespace App\Http\Requests;

use App\Models\BlogTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBlogTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_tag_create');
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
                'unique:blog_tags',
            ],
            'author_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
