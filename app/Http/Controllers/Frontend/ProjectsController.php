<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Facility;
use App\Models\Investor;
use App\Models\Project;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::with(['country', 'state', 'city', 'property_features', 'property_type', 'features', 'facilities', 'investors', 'created_by', 'media'])->get();

        $countries = Country::get();

        $states = State::get();

        $cities = City::get();

        $property_features = PropertyFeature::get();

        $property_types = PropertyType::get();

        $facilities = Facility::get();

        $investors = Investor::get();

        $users = User::get();

        return view('frontend.projects.index', compact('projects', 'countries', 'states', 'cities', 'property_features', 'property_types', 'facilities', 'investors', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_features = PropertyFeature::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_types = PropertyType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $features = PropertyFeature::all()->pluck('title', 'id');

        $facilities = Facility::all()->pluck('title', 'id');

        $investors = Investor::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.projects.create', compact('countries', 'states', 'cities', 'property_features', 'property_types', 'features', 'facilities', 'investors'));
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->all());
        $project->features()->sync($request->input('features', []));
        $project->facilities()->sync($request->input('facilities', []));
        if ($request->input('picture_image', false)) {
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        foreach ($request->input('gallery_images', []) as $file) {
            $project->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
        }

        if ($request->input('video_thumb', false)) {
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('video_thumb'))))->toMediaCollection('video_thumb');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $project->id]);
        }

        return redirect()->route('frontend.projects.index');
    }

    public function edit(Project $project)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_features = PropertyFeature::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_types = PropertyType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $features = PropertyFeature::all()->pluck('title', 'id');

        $facilities = Facility::all()->pluck('title', 'id');

        $investors = Investor::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project->load('country', 'state', 'city', 'property_features', 'property_type', 'features', 'facilities', 'investors', 'created_by');

        return view('frontend.projects.edit', compact('countries', 'states', 'cities', 'property_features', 'property_types', 'features', 'facilities', 'investors', 'project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->all());
        $project->features()->sync($request->input('features', []));
        $project->facilities()->sync($request->input('facilities', []));
        if ($request->input('picture_image', false)) {
            if (!$project->picture_image || $request->input('picture_image') !== $project->picture_image->file_name) {
                if ($project->picture_image) {
                    $project->picture_image->delete();
                }
                $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
            }
        } elseif ($project->picture_image) {
            $project->picture_image->delete();
        }

        if (count($project->gallery_images) > 0) {
            foreach ($project->gallery_images as $media) {
                if (!in_array($media->file_name, $request->input('gallery_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $project->gallery_images->pluck('file_name')->toArray();
        foreach ($request->input('gallery_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $project->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
            }
        }

        if ($request->input('video_thumb', false)) {
            if (!$project->video_thumb || $request->input('video_thumb') !== $project->video_thumb->file_name) {
                if ($project->video_thumb) {
                    $project->video_thumb->delete();
                }
                $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('video_thumb'))))->toMediaCollection('video_thumb');
            }
        } elseif ($project->video_thumb) {
            $project->video_thumb->delete();
        }

        return redirect()->route('frontend.projects.index');
    }

    public function show(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->load('country', 'state', 'city', 'property_features', 'property_type', 'features', 'facilities', 'investors', 'created_by');

        return view('frontend.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectRequest $request)
    {
        Project::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('project_create') && Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Project();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
