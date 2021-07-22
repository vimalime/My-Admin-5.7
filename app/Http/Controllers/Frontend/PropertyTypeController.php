<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPropertyTypeRequest;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use App\Models\PropertyType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('property_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyTypes = PropertyType::all();

        return view('frontend.propertyTypes.index', compact('propertyTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('property_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.propertyTypes.create');
    }

    public function store(StorePropertyTypeRequest $request)
    {
        $propertyType = PropertyType::create($request->all());

        return redirect()->route('frontend.property-types.index');
    }

    public function edit(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.propertyTypes.edit', compact('propertyType'));
    }

    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertyType)
    {
        $propertyType->update($request->all());

        return redirect()->route('frontend.property-types.index');
    }

    public function show(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.propertyTypes.show', compact('propertyType'));
    }

    public function destroy(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyType->delete();

        return back();
    }

    public function massDestroy(MassDestroyPropertyTypeRequest $request)
    {
        PropertyType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
