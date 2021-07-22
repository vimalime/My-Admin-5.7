@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.permalink.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.permalinks.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.permalinks.index') }}">
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