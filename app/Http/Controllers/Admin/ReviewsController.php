<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Investor;
use App\Models\Package;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use App\Models\Property;
use App\Models\Review;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReviewsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Review::with(['created_by', 'page_link', 'user_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link'])->select(sprintf('%s.*', (new Review())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'review_show';
                $editGate = 'review_edit';
                $deleteGate = 'review_delete';
                $crudRoutePart = 'reviews';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('excerpt', function ($row) {
                return $row->excerpt ? $row->excerpt : '';
            });
            $table->editColumn('user_name', function ($row) {
                return $row->user_name ? $row->user_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users      = User::get();
        $pages      = Page::get();
        $products   = Product::get();
        $careers    = Career::get();
        $properties = Property::get();
        $projects   = Project::get();
        $blogs      = Blog::get();
        $packages   = Package::get();
        $investors  = Investor::get();

        return view('admin.reviews.index', compact('users', 'pages', 'products', 'careers', 'properties', 'projects', 'blogs', 'packages', 'investors'));
    }

    public function create()
    {
        abort_if(Gate::denies('review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $page_links = Page::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_links = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_links = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $careers_links = Career::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_links = Property::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project_links = Project::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog_links = Blog::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $package_links = Package::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $investor_links = Investor::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reviews.create', compact('created_bies', 'page_links', 'user_links', 'product_links', 'careers_links', 'property_links', 'project_links', 'blog_links', 'package_links', 'investor_links'));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->all());

        return redirect()->route('admin.reviews.index');
    }

    public function edit(Review $review)
    {
        abort_if(Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $page_links = Page::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_links = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_links = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $careers_links = Career::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_links = Property::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project_links = Project::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blog_links = Blog::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $package_links = Package::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $investor_links = Investor::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $review->load('created_by', 'page_link', 'user_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link');

        return view('admin.reviews.edit', compact('created_bies', 'page_links', 'user_links', 'product_links', 'careers_links', 'property_links', 'project_links', 'blog_links', 'package_links', 'investor_links', 'review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());

        return redirect()->route('admin.reviews.index');
    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->load('created_by', 'page_link', 'user_link', 'product_link', 'careers_link', 'property_link', 'project_link', 'blog_link', 'package_link', 'investor_link');

        return view('admin.reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();

        return back();
    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        Review::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
