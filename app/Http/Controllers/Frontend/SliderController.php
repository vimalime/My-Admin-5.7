<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySliderRequest;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Investor;
use App\Models\Package;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Property;
use App\Models\Slider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliders = Slider::with(['page_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link', 'created_by', 'media'])->get();

        return view('frontend.sliders.index', compact('sliders'));
    }

    public function create()
    {
        abort_if(Gate::denies('slider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page_links = Page::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_links = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $careers_links = Career::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_links = Property::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project_links = Project::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog_links = Blog::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $package_links = Package::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $investor_links = Investor::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.sliders.create', compact('page_links', 'product_links', 'careers_links', 'property_links', 'project_links', 'blog_links', 'package_links', 'investor_links'));
    }

    public function store(StoreSliderRequest $request)
    {
        $slider = Slider::create($request->all());

        if ($request->input('slider_image', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('slider_image'))))->toMediaCollection('slider_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $slider->id]);
        }

        return redirect()->route('frontend.sliders.index');
    }

    public function edit(Slider $slider)
    {
        abort_if(Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page_links = Page::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_links = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $careers_links = Career::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_links = Property::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project_links = Project::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog_links = Blog::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $package_links = Package::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $investor_links = Investor::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $slider->load('page_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link', 'created_by');

        return view('frontend.sliders.edit', compact('page_links', 'product_links', 'careers_links', 'property_links', 'project_links', 'blog_links', 'package_links', 'investor_links', 'slider'));
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

        return redirect()->route('frontend.sliders.index');
    }

    public function show(Slider $slider)
    {
        abort_if(Gate::denies('slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slider->load('page_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link', 'created_by');

        return view('frontend.sliders.show', compact('slider'));
    }

    public function destroy(Slider $slider)
    {
        abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slider->delete();

        return back();
    }

    public function massDestroy(MassDestroySliderRequest $request)
    {
        Slider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('slider_create') && Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Slider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
