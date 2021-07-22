<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPropertyFeatureRequest;
use App\Http\Requests\StorePropertyFeatureRequest;
use App\Http\Requests\UpdatePropertyFeatureRequest;
use App\Models\PropertyFeature;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyFeaturesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('property_feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeatures = PropertyFeature::with(['created_by'])->get();

        return view('frontend.propertyFeatures.index', compact('propertyFeatures'));
    }

    public function create()
    {
        abort_if(Gate::denies('property_feature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.propertyFeatures.create');
    }

    public function store(StorePropertyFeatureRequest $request)
    {
        $propertyFeature = PropertyFeature::create($request->all());

        return redirect()->route('frontend.property-features.index');
    }

    public function edit(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeature->load('created_by');

        return view('frontend.propertyFeatures.edit', compact('propertyFeature'));
    }

    public function update(UpdatePropertyFeatureRequest $request, PropertyFeature $propertyFeature)
    {
        $propertyFeature->update($request->all());

        return redirect()->route('frontend.property-features.index');
    }

    public function show(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeature->load('created_by');

        return view('frontend.propertyFeatures.show', compact('propertyFeature'));
    }

    public function destroy(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeature->delete();

        return back();
    }

    public function massDestroy(MassDestroyPropertyFeatureRequest $request)
    {
        PropertyFeature::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
