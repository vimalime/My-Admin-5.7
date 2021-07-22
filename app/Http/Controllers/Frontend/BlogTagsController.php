<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBlogTagRequest;
use App\Http\Requests\StoreBlogTagRequest;
use App\Http\Requests\UpdateBlogTagRequest;
use App\Models\BlogTag;
use App\Models\Template;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogTagsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTags = BlogTag::with(['template', 'author', 'created_by'])->get();

        return view('frontend.blogTags.index', compact('blogTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('blog_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.blogTags.create', compact('templates', 'authors'));
    }

    public function store(StoreBlogTagRequest $request)
    {
        $blogTag = BlogTag::create($request->all());

        return redirect()->route('frontend.blog-tags.index');
    }

    public function edit(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blogTag->load('template', 'author', 'created_by');

        return view('frontend.blogTags.edit', compact('templates', 'authors', 'blogTag'));
    }

    public function update(UpdateBlogTagRequest $request, BlogTag $blogTag)
    {
        $blogTag->update($request->all());

        return redirect()->route('frontend.blog-tags.index');
    }

    public function show(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTag->load('template', 'author', 'created_by');

        return view('frontend.blogTags.show', compact('blogTag'));
    }

    public function destroy(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogTagRequest $request)
    {
        BlogTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
