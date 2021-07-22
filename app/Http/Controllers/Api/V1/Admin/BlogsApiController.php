<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\Admin\BlogResource;
use App\Models\Blog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogResource(Blog::with(['blog_categories', 'blog_tags', 'template', 'created_by'])->get());
    }

    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());

        if ($request->input('picture_image', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        if ($request->input('gallery_images', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
        }

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Blog $blog)
    {
        abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogResource($blog->load(['blog_categories', 'blog_tags', 'template', 'created_by']));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());

        if ($request->input('picture_image', false)) {
            if (!$blog->picture_image || $request->input('picture_image') !== $blog->picture_image->file_name) {
                if ($blog->picture_image) {
                    $blog->picture_image->delete();
                }
                $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
            }
        } elseif ($blog->picture_image) {
            $blog->picture_image->delete();
        }

        if ($request->input('gallery_images', false)) {
            if (!$blog->gallery_images || $request->input('gallery_images') !== $blog->gallery_images->file_name) {
                if ($blog->gallery_images) {
                    $blog->gallery_images->delete();
                }
                $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_images'))))->toMediaCollection('gallery_images');
            }
        } elseif ($blog->gallery_images) {
            $blog->gallery_images->delete();
        }

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
