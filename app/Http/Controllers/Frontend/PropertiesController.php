<?php

namespace App\Http\Controllers\Frontend;

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

class PropertiesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::with(['country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by', 'media'])->get();

        $countries = Country::get();

        $states = State::get();

        $cities = City::get();

        $property_types = PropertyType::get();

        $property_features = PropertyFeature::get();

        $facilities = Facility::get();

        $projects = Project::get();

        $users = User::get();

        return view('frontend.properties.index', compact('properties', 'countries', 'states', 'cities', 'property_types', 'property_features', 'facilities', 'projects', 'users'));
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

        return view('frontend.properties.create', compact('countries', 'states', 'cities', 'property_types', 'property_features', 'facilities', 'projects', 'authors'));
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

        return redirect()->route('frontend.properties.index');
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

        return view('frontend.properties.edit', compact('countries', 'states', 'cities', 'property_types', 'property_features', 'facilities', 'projects', 'authors', 'property'));
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

        return redirect()->route('frontend.properties.index');
    }

    public function show(Property $property)
    {
        abort_if(Gate::denies('property_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->load('country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by');

        return view('frontend.properties.show', compact('property'));
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
