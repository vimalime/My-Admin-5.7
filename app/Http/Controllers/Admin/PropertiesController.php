<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPropertyRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Facility;
use App\Models\Project;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PropertiesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Property::with(['country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by'])->select(sprintf('%s.*', (new Property())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'property_show';
                $editGate = 'property_edit';
                $deleteGate = 'property_delete';
                $crudRoutePart = 'properties';

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
            $table->editColumn('is_featured', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_featured ? 'checked' : null) . '>';
            });
            $table->editColumn('is_premium', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_premium ? 'checked' : null) . '>';
            });
            $table->editColumn('moderation_status', function ($row) {
                return $row->moderation_status ? Property::MODERATION_STATUS_SELECT[$row->moderation_status] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Property::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('selling_status', function ($row) {
                return $row->selling_status ? Property::SELLING_STATUS_SELECT[$row->selling_status] : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_featured', 'is_premium', 'created_by']);

            return $table->make(true);
        }

        $countries         = Country::get();
        $states            = State::get();
        $cities            = City::get();
        $property_types    = PropertyType::get();
        $property_features = PropertyFeature::get();
        $facilities        = Facility::get();
        $projects          = Project::get();
        $users             = User::get();

        return view('admin.properties.index', compact('countries', 'states', 'cities', 'property_types', 'property_features', 'facilities', 'projects', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('property_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_types = PropertyType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_features = PropertyFeature::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.properties.create', compact('countries', 'states', 'cities', 'property_types', 'property_features', 'facilities', 'projects', 'authors'));
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());

        if ($request->input('picture_image', false)) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        foreach ($request->input('gallery_images', []) as $file) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
        }

        if ($request->input('video_thumb', false)) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('video_thumb'))))->toMediaCollection('video_thumb');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $property->id]);
        }

        return redirect()->route('admin.properties.index');
    }

    public function edit(Property $property)
    {
        abort_if(Gate::denies('property_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_types = PropertyType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_features = PropertyFeature::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property->load('country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by');

        return view('admin.properties.edit', compact('countries', 'states', 'cities', 'property_types', 'property_features', 'facilities', 'projects', 'authors', 'property'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $property->update($request->all());

        if ($request->input('picture_image', false)) {
            if (!$property->picture_image || $request->input('picture_image') !== $property->picture_image->file_name) {
                if ($property->picture_image) {
                    $property->picture_image->delete();
                }
                $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
            }
        } elseif ($property->picture_image) {
            $property->picture_image->delete();
        }

        if (count($property->gallery_images) > 0) {
            foreach ($property->gallery_images as $media) {
                if (!in_array($media->file_name, $request->input('gallery_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $property->gallery_images->pluck('file_name')->toArray();
        foreach ($request->input('gallery_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $property->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
            }
        }

        if ($request->input('video_thumb', false)) {
            if (!$property->video_thumb || $request->input('video_thumb') !== $property->video_thumb->file_name) {
                if ($property->video_thumb) {
                    $property->video_thumb->delete();
                }
                $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('video_thumb'))))->toMediaCollection('video_thumb');
            }
        } elseif ($property->video_thumb) {
            $property->video_thumb->delete();
        }

        return redirect()->route('admin.properties.index');
    }

    public function show(Property $property)
    {
        abort_if(Gate::denies('property_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->load('country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by', 'propertyLinkReviews', 'propertyLinkSliders');

        return view('admin.properties.show', compact('property'));
    }

    public function destroy(Property $property)
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->delete();

        return back();
    }

    public function massDestroy(MassDestroyPropertyRequest $request)
    {
        Property::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('property_create') && Gate::denies('property_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Property();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
