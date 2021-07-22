<?php

namespace App\Http\Requests;

use App\Models\BlogCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBlogCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_category_edit');
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
                'unique:blog_categories,slug,' . request()->route('blog_category')->id,
            ],
            'status' => [
                'required',
            ],
            'author_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
