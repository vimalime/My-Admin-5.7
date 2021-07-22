<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogTagRequest;
use App\Http\Requests\UpdateBlogTagRequest;
use App\Http\Resources\Admin\BlogTagResource;
use App\Models\BlogTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogTagsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('blog_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogTagResource(BlogTag::with(['template', 'author', 'created_by'])->get());
    }

    public function store(StoreBlogTagRequest $request)
    {
        $blogTag = BlogTag::create($request->all());

        return (new BlogTagResource($blogTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogTagResource($blogTag->load(['template', 'author', 'created_by']));
    }

    public function update(UpdateBlogTagRequest $request, BlogTag $blogTag)
    {
        $blogTag->update($request->all());

        return (new BlogTagResource($blogTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
