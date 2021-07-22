<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use App\Http\Resources\Admin\PropertyTypeResource;
use App\Models\PropertyType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('property_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyTypeResource(PropertyType::all());
    }

    public function store(StorePropertyTypeRequest $request)
    {
        $propertyType = PropertyType::create($request->all());

        return (new PropertyTypeResource($propertyType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyTypeResource($propertyType);
    }

    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertyType)
    {
        $propertyType->update($request->all());

        return (new PropertyTypeResource($propertyType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
