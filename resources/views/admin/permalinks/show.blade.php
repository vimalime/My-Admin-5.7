@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.permalink.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.permalinks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $permalink->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.pages') }}
                                    </th>
                                    <td>
                                        {{ $permalink->pages }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.blog_posts') }}
                                    </th>
                                    <td>
                                        {{ $permalink->blog_posts }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.blog_categories') }}
                                    </th>
                                    <td>
                                        {{ $permalink->blog_categories }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.blog_tags') }}
                                    </th>
                                    <td>
                                        {{ $permalink->blog_tags }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.careers') }}
                                    </th>
                                    <td>
                                        {{ $permalink->careers }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.real_estate_properties') }}
                                    </th>
                                    <td>
                                        {{ $permalink->real_estate_properties }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.real_estate_property_categories') }}
                                    </th>
                                    <td>
                                        {{ $permalink->real_estate_property_categories }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.permalink.fields.real_estate_projects') }}
                                    </th>
                                    <td>
                                        {{ $permalink->real_estate_projects }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.permalinks.index') }}">
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