<?php

namespace App\Http\Requests;

use App\Models\BlogTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBlogTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_tag_edit');
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
                'unique:blog_tags,slug,' . request()->route('blog_tag')->id,
            ],
            'author_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
