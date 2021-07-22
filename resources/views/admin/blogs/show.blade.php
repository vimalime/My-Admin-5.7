@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.blog.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.blogs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $blog->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $blog->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $blog->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.is_featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $blog->is_featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.is_premium') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $blog->is_premium ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $blog->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $blog->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.blog_categories') }}
                                    </th>
                                    <td>
                                        {{ $blog->blog_categories->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.blog_tags') }}
                                    </th>
                                    <td>
                                        {{ $blog->blog_tags->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.post_date') }}
                                    </th>
                                    <td>
                                        {{ $blog->post_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($blog->picture_image)
                                            <a href="{{ $blog->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $blog->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($blog->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.meta_title') }}
                                    </th>
                                    <td>
                                        {{ $blog->meta_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.meta_description') }}
                                    </th>
                                    <td>
                                        {{ $blog->meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.meta_keywords') }}
                                    </th>
                                    <td>
                                        {{ $blog->meta_keywords }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Blog::STATUS_SELECT[$blog->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $blog->template->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.format') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Blog::FORMAT_SELECT[$blog->format] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $blog->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $blog->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $blog->deleted_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $blog->created_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.blogs.index') }}">
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
                        <a href="#blog_link_reviews" aria-controls="blog_link_reviews" role="tab" data-toggle="tab">
                            {{ trans('cruds.review.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#blog_link_sliders" aria-controls="blog_link_sliders" role="tab" data-toggle="tab">
                            {{ trans('cruds.slider.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="blog_link_reviews">
                        @includeIf('admin.blogs.relationships.blogLinkReviews', ['reviews' => $blog->blogLinkReviews])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="blog_link_sliders">
                        @includeIf('admin.blogs.relationships.blogLinkSliders', ['sliders' => $blog->blogLinkSliders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection