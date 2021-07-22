<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductCategoryRequest;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Models\Template;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategories = ProductCategory::with(['parent', 'template', 'created_by', 'media'])->get();

        return view('frontend.productCategories.index', compact('productCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = ProductCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.productCategories.create', compact('parents', 'templates'));
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create($request->all());

        if ($request->input('picture_image', false)) {
            $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        foreach ($request->input('gallery_images', []) as $file) {
            $productCategory->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productCategory->id]);
        }

        return redirect()->route('frontend.product-categories.index');
    }

    public function edit(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = ProductCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productCategory->load('parent', 'template', 'created_by');

        return view('frontend.productCategories.edit', compact('parents', 'templates', 'productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        if ($request->input('picture_image', false)) {
            if (!$productCategory->picture_image || $request->input('picture_image') !== $productCategory->picture_image->file_name) {
                if ($productCategory->picture_image) {
                    $productCategory->picture_image->delete();
                }
                $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
            }
        } elseif ($productCategory->picture_image) {
            $productCategory->picture_image->delete();
        }

        if (count($productCategory->gallery_images) > 0) {
            foreach ($productCategory->gallery_images as $media) {
                if (!in_array($media->file_name, $request->input('gallery_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $productCategory->gallery_images->pluck('file_name')->toArray();
        foreach ($request->input('gallery_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $productCategory->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
            }
        }

        return redirect()->route('frontend.product-categories.index');
    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->load('parent', 'template', 'created_by', 'parentProductCategories');

        return view('frontend.productCategories.show', compact('productCategory'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCategoryRequest $request)
    {
        ProductCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_category_create') && Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
