<?php

namespace App\Http\Requests;

use App\Models\Permalink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPermalinkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('permalink_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:permalinks,id',
        ];
    }
}
