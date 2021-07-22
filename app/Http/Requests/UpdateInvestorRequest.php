<?php

namespace App\Http\Requests;

use App\Models\Investor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInvestorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('investor_edit');
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
                'unique:investors,slug,' . request()->route('investor')->id,
            ],
        ];
    }
}
