@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.propertyFeature.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.property-features.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.icon') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->icon }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyFeature.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $propertyFeature->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.property-features.index') }}">
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