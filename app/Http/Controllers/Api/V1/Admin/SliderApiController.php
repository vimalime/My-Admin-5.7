<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Resources\Admin\SliderResource;
use App\Models\Slider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SliderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SliderResource(Slider::with(['page_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link', 'created_by'])->get());
    }

    public function store(StoreSliderRequest $request)
    {
        $slider = Slider::create($request->all());

        if ($request->input('slider_image', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('slider_image'))))->toMediaCollection('slider_image');
        }

        return (new SliderResource($slider))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Slider $slider)
    {
        abort_if(Gate::denies('slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SliderResource($slider->load(['page_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link', 'created_by']));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update($request->all());

        if ($request->input('slider_image', false)) {
            if (!$slider->slider_image || $request->input('slider_image') !== $slider->slider_image->file_name) {
                if ($slider->slider_image) {
                    $slider->slider_image->delete();
                }
                $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('slider_image'))))->toMediaCollection('slider_image');
            }
        } elseif ($slider->slider_image) {
            $slider->slider_image->delete();
        }

        return (new SliderResource($slider))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Slider $slider)
    {
        abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slider->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
