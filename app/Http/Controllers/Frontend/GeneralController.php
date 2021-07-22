<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGeneralRequest;
use App\Http\Requests\StoreGeneralRequest;
use App\Http\Requests\UpdateGeneralRequest;
use App\Models\General;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('general_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generals = General::with(['created_by', 'media'])->get();

        return view('frontend.generals.index', compact('generals'));
    }

    public function create()
    {
        abort_if(Gate::denies('general_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.generals.create');
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $general->id]);
        }

        return redirect()->route('frontend.generals.index');
    }

    public function edit(General $general)
    {
        abort_if(Gate::denies('general_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $general->load('created_by');

        return view('frontend.generals.edit', compact('general'));
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

        return redirect()->route('frontend.generals.index');
    }

    public function show(General $general)
    {
        abort_if(Gate::denies('general_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $general->load('created_by');

        return view('frontend.generals.show', compact('general'));
    }

    public function destroy(General $general)
    {
        abort_if(Gate::denies('general_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $general->delete();

        return back();
    }

    public function massDestroy(MassDestroyGeneralRequest $request)
    {
        General::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('general_create') && Gate::denies('general_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new General();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
