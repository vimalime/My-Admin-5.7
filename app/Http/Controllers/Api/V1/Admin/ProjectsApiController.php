<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\Admin\ProjectResource;
use App\Models\Project;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProjectResource(Project::with(['country', 'state', 'city', 'property_features', 'property_type', 'features', 'facilities', 'investors', 'created_by'])->get());
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->all());
        $project->features()->sync($request->input('features', []));
        $project->facilities()->sync($request->input('facilities', []));
        if ($request->input('picture_image', false)) {
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        if ($request->input('gallery_images', false)) {
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
        }

        if ($request->input('video_thumb', false)) {
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('video_thumb'))))->toMediaCollection('video_thumb');
        }

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProjectResource($project->load(['country', 'state', 'city', 'property_features', 'property_type', 'features', 'facilities', 'investors', 'created_by']));
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

        if ($request->input('gallery_images', false)) {
            if (!$project->gallery_images || $request->input('gallery_images') !== $project->gallery_images->file_name) {
                if ($project->gallery_images) {
                    $project->gallery_images->delete();
                }
                $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
            }
        } elseif ($project->gallery_images) {
            $project->gallery_images->delete();
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

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Project $project)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
