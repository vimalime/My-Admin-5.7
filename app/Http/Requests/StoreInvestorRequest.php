<?php

namespace App\Http\Requests;

use App\Models\Investor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInvestorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('investor_create');
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
                'unique:investors',
            ],
        ];
    }
}
