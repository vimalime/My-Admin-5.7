<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\Admin\PropertyResource;
use App\Models\Property;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertiesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyResource(Property::with(['country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by'])->get());
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());

        if ($request->input('picture_image', false)) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        if ($request->input('gallery_images', false)) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
        }

        if ($request->input('video_thumb', false)) {
            $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('video_thumb'))))->toMediaCollection('video_thumb');
        }

        return (new PropertyResource($property))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Property $property)
    {
        abort_if(Gate::denies('property_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PropertyResource($property->load(['country', 'state', 'city', 'property_type', 'property_features', 'facilities', 'project', 'author', 'created_by']));
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

        if ($request->input('gallery_images', false)) {
            if (!$property->gallery_images || $request->input('gallery_images') !== $property->gallery_images->file_name) {
                if ($property->gallery_images) {
                    $property->gallery_images->delete();
                }
                $property->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
            }
        } elseif ($property->gallery_images) {
            $property->gallery_images->delete();
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

        return (new PropertyResource($property))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Property $property)
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
