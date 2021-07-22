<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Http\Resources\Admin\CareerResource;
use App\Models\Career;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CareersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('career_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CareerResource(Career::with(['created_by'])->get());
    }

    public function store(StoreCareerRequest $request)
    {
        $career = Career::create($request->all());

        if ($request->input('picture_image', false)) {
            $career->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        if ($request->input('gallery_images', false)) {
            $career->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
        }

        return (new CareerResource($career))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Career $career)
    {
        abort_if(Gate::denies('career_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CareerResource($career->load(['created_by']));
    }

    public function update(UpdateCareerRequest $request, Career $career)
    {
        $career->update($request->all());

        if ($request->input('picture_image', false)) {
            if (!$career->picture_image || $request->input('picture_image') !== $career->picture_image->file_name) {
                if ($career->picture_image) {
                    $career->picture_image->delete();
                }
                $career->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
            }
        } elseif ($career->picture_image) {
            $career->picture_image->delete();
        }

        if ($request->input('gallery_images', false)) {
            if (!$career->gallery_images || $request->input('gallery_images') !== $career->gallery_images->file_name) {
                if ($career->gallery_images) {
                    $career->gallery_images->delete();
                }
                $career->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
            }
        } elseif ($career->gallery_images) {
            $career->gallery_images->delete();
        }

        return (new CareerResource($career))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Career $career)
    {
        abort_if(Gate::denies('career_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $career->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
