@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.blogTag.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.blog-tags.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BlogTag::STATUS_SELECT[$blogTag->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->template->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.author') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->author->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogTag.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $blogTag->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.blog-tags.index') }}">
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
                        <a href="#blog_tags_blogs" aria-controls="blog_tags_blogs" role="tab" data-toggle="tab">
                            {{ trans('cruds.blog.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="blog_tags_blogs">
                        @includeIf('admin.blogTags.relationships.blogTagsBlogs', ['blogs' => $blogTag->blogTagsBlogs])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection