<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Http\Resources\Admin\BlogCategoryResource;
use App\Models\BlogCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogCategoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogCategoryResource(BlogCategory::with(['parent', 'template', 'author', 'created_by'])->get());
    }

    public function store(StoreBlogCategoryRequest $request)
    {
        $blogCategory = BlogCategory::create($request->all());

        if ($request->input('picture_image', false)) {
            $blogCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        if ($request->input('gallery_images', false)) {
            $blogCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
        }

        return (new BlogCategoryResource($blogCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BlogCategory $blogCategory)
    {
        abort_if(Gate::denies('blog_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogCategoryResource($blogCategory->load(['parent', 'template', 'author', 'created_by']));
    }

    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $blogCategory->update($request->all());

        if ($request->input('picture_image', false)) {
            if (!$blogCategory->picture_image || $request->input('picture_image') !== $blogCategory->picture_image->file_name) {
                if ($blogCategory->picture_image) {
                    $blogCategory->picture_image->delete();
                }
                $blogCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
            }
        } elseif ($blogCategory->picture_image) {
            $blogCategory->picture_image->delete();
        }

        if ($request->input('gallery_images', false)) {
            if (!$blogCategory->gallery_images || $request->input('gallery_images') !== $blogCategory->gallery_images->file_name) {
                if ($blogCategory->gallery_images) {
                    $blogCategory->gallery_images->delete();
                }
                $blogCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
            }
        } elseif ($blogCategory->gallery_images) {
            $blogCategory->gallery_images->delete();
        }

        return (new BlogCategoryResource($blogCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BlogCategory $blogCategory)
    {
        abort_if(Gate::denies('blog_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
