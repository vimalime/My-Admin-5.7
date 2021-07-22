<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPropertyTypeRequest;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use App\Models\PropertyType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PropertyTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('property_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PropertyType::query()->select(sprintf('%s.*', (new PropertyType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'property_type_show';
                $editGate = 'property_type_edit';
                $deleteGate = 'property_type_delete';
                $crudRoutePart = 'property-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PropertyType::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.propertyTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('property_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.propertyTypes.create');
    }

    public function store(StorePropertyTypeRequest $request)
    {
        $propertyType = PropertyType::create($request->all());

        return redirect()->route('admin.property-types.index');
    }

    public function edit(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.propertyTypes.edit', compact('propertyType'));
    }

    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertyType)
    {
        $propertyType->update($request->all());

        return redirect()->route('admin.property-types.index');
    }

    public function show(PropertyType $propertyType)
    {
        abort_if(Gate::denies('property_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertyType->load('propertyTypeProjects', 'propertyTypeProperties');

        return view('admin.propertyTypes.show', compact('propertyType'));
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
