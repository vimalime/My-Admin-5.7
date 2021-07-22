<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BlogTagsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('blog_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BlogTag::with(['template', 'author', 'created_by'])->select(sprintf('%s.*', (new BlogTag())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'blog_tag_show';
                $editGate = 'blog_tag_edit';
                $deleteGate = 'blog_tag_delete';
                $crudRoutePart = 'blog-tags';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BlogTag::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.blogTags.index');
    }

    public function create()
    {
        abort_if(Gate::denies('blog_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.blogTags.create', compact('templates', 'authors'));
    }

    public function store(StoreBlogTagRequest $request)
    {
        $blogTag = BlogTag::create($request->all());

        return redirect()->route('admin.blog-tags.index');
    }

    public function edit(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blogTag->load('template', 'author', 'created_by');

        return view('admin.blogTags.edit', compact('templates', 'authors', 'blogTag'));
    }

    public function update(UpdateBlogTagRequest $request, BlogTag $blogTag)
    {
        $blogTag->update($request->all());

        return redirect()->route('admin.blog-tags.index');
    }

    public function show(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTag->load('template', 'author', 'created_by', 'blogTagsBlogs');

        return view('admin.blogTags.show', compact('blogTag'));
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
