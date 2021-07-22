<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyFeatureRequest;
use App\Http\Requests\UpdatePropertyFeatureRequest;
use App\Http\Resources\Admin\PropertyFeatureResource;
use App\Models\PropertyFeature;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyFeaturesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('property_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyFeatureResource(PropertyFeature::with(['created_by'])->get());
    }

    public function store(StorePropertyFeatureRequest $request)
    {
        $propertyFeature = PropertyFeature::create($request->all());

        return (new PropertyFeatureResource($propertyFeature))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyFeatureResource($propertyFeature->load(['created_by']));
    }

    public function update(UpdatePropertyFeatureRequest $request, PropertyFeature $propertyFeature)
    {
        $propertyFeature->update($request->all());

        return (new PropertyFeatureResource($propertyFeature))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeature->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
