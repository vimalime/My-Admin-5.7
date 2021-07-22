<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGeneralRequest;
use App\Http\Requests\UpdateGeneralRequest;
use App\Http\Resources\Admin\GeneralResource;
use App\Models\General;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('general_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GeneralResource(General::with(['created_by'])->get());
    }

    public function store(StoreGeneralRequest $request)
    {
        $general = General::create($request->all());

        if ($request->input('admin_logo', false)) {
            $general->addMedia(storage_path('tmp/uploads/' . basename($request->input('admin_logo'))))->toMediaCollection('admin_logo');
        }

        if ($request->input('admin_favicon', false)) {
            $general->addMedia(storage_path('tmp/uploads/' . basename($request->input('admin_favicon'))))->toMediaCollection('admin_favicon');
        }

        if ($request->input('background_image', false)) {
            $general->addMedia(storage_path('tmp/uploads/' . basename($request->input('background_image'))))->toMediaCollection('background_image');
        }

        return (new GeneralResource($general))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(General $general)
    {
        abort_if(Gate::denies('general_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GeneralResource($general->load(['created_by']));
    }

    public function update(UpdateGeneralRequest $request, General $general)
    {
        $general->update($request->all());

        if ($request->input('admin_logo', false)) {
            if (!$general->admin_logo || $request->input('admin_logo') !== $general->admin_logo->file_name) {
                if ($general->admin_logo) {
                    $general->admin_logo->delete();
                }
                $general->addMedia(storage_path('tmp/uploads/' . basename($request->input('admin_logo'))))->toMediaCollection('admin_logo');
            }
        } elseif ($general->admin_logo) {
            $general->admin_logo->delete();
        }

        if ($request->input('admin_favicon', false)) {
            if (!$general->admin_favicon || $request->input('admin_favicon') !== $general->admin_favicon->file_name) {
                if ($general->admin_favicon) {
                    $general->admin_favicon->delete();
                }
                $general->addMedia(storage_path('tmp/uploads/' . basename($request->input('admin_favicon'))))->toMediaCollection('admin_favicon');
            }
        } elseif ($general->admin_favicon) {
            $general->admin_favicon->delete();
        }

        if ($request->input('background_image', false)) {
            if (!$general->background_image || $request->input('background_image') !== $general->background_image->file_name) {
                if ($general->background_image) {
                    $general->background_image->delete();
                }
                $general->addMedia(storage_path('tmp/uploads/' . basename($request->input('background_image'))))->toMediaCollection('background_image');
            }
        } elseif ($general->background_image) {
            $general->background_image->delete();
        }

        return (new GeneralResource($general))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(General $general)
    {
        abort_if(Gate::denies('general_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $general->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
