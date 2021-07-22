<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Template;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BlogsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Blog::with(['blog_categories', 'blog_tags', 'template', 'created_by'])->select(sprintf('%s.*', (new Blog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'blog_show';
                $editGate = 'blog_edit';
                $deleteGate = 'blog_delete';
                $crudRoutePart = 'blogs';

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
            $table->editColumn('is_featured', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_featured ? 'checked' : null) . '>';
            });
            $table->editColumn('is_premium', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_premium ? 'checked' : null) . '>';
            });
            $table->addColumn('blog_categories_name', function ($row) {
                return $row->blog_categories ? $row->blog_categories->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Blog::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('format', function ($row) {
                return $row->format ? Blog::FORMAT_SELECT[$row->format] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_featured', 'is_premium', 'blog_categories']);

            return $table->make(true);
        }

        $blog_categories = BlogCategory::get();
        $blog_tags       = BlogTag::get();
        $templates       = Template::get();
        $users           = User::get();

        return view('admin.blogs.index', compact('blog_categories', 'blog_tags', 'templates', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog_categories = BlogCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog_tags = BlogTag::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.blogs.create', compact('blog_categories', 'blog_tags', 'templates'));
    }

    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());

        if ($request->input('picture_image', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture_image'))))->toMediaCollection('picture_image');
        }

        foreach ($request->input('gallery_images', []) as $file) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blog->id]);
        }

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Blog $blog)
    {
        abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog_categories = BlogCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog_tags = BlogTag::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = Template::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog->load('blog_categories', 'blog_tags', 'template', 'created_by');

        return view('admin.blogs.edit', compact('blog_categories', 'blog_tags', 'templates', 'blog'));
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

        if (count($blog->gallery_images) > 0) {
            foreach ($blog->gallery_images as $media) {
                if (!in_array($media->file_name, $request->input('gallery_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $blog->gallery_images->pluck('file_name')->toArray();
        foreach ($request->input('gallery_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $blog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery_images');
            }
        }

        return redirect()->route('admin.blogs.index');
    }

    public function show(Blog $blog)
    {
        abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->load('blog_categories', 'blog_tags', 'template', 'created_by', 'blogLinkReviews', 'blogLinkSliders');

        return view('admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogRequest $request)
    {
        Blog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('blog_create') && Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Blog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
