<?php

namespace App\Http\Requests;

use App\Models\PropertyFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPropertyFeatureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('property_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:property_features,id',
        ];
    }
}
