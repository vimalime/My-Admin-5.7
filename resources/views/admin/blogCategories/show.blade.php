@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.blogCategory.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.blog-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.parent') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->parent->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $blogCategory->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BlogCategory::STATUS_SELECT[$blogCategory->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($blogCategory->picture_image)
                                            <a href="{{ $blogCategory->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $blogCategory->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($blogCategory->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->template->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.author') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->author->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $blogCategory->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.blog-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#blog_categories_blogs" aria-controls="blog_categories_blogs" role="tab" data-toggle="tab">
                            {{ trans('cruds.blog.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="blog_categories_blogs">
                        @includeIf('admin.blogCategories.relationships.blogCategoriesBlogs', ['blogs' => $blogCategory->blogCategoriesBlogs])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection