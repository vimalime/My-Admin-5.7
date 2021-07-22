<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.propertyFeatures.index', compact('propertyFeatures'));
    }

    public function create()
    {
        abort_if(Gate::denies('property_feature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.propertyFeatures.create');
    }

    public function store(StorePropertyFeatureRequest $request)
    {
        $propertyFeature = PropertyFeature::create($request->all());

        return redirect()->route('admin.property-features.index');
    }

    public function edit(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeature->load('created_by');

        return view('admin.propertyFeatures.edit', compact('propertyFeature'));
    }

    public function update(UpdatePropertyFeatureRequest $request, PropertyFeature $propertyFeature)
    {
        $propertyFeature->update($request->all());

        return redirect()->route('admin.property-features.index');
    }

    public function show(PropertyFeature $propertyFeature)
    {
        abort_if(Gate::denies('property_feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyFeature->load('created_by', 'propertyFeaturesProjects', 'propertyFeaturesProperties', 'featuresProjects');

        return view('admin.propertyFeatures.show', compact('propertyFeature'));
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
