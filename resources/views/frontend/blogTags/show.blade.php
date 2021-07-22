@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.blogTag.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.blog-tags.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.blog-tags.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection