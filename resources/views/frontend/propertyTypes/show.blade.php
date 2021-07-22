@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.propertyType.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.property-types.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $propertyType->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $propertyType->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $propertyType->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\PropertyType::STATUS_SELECT[$propertyType->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $propertyType->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $propertyType->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $propertyType->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.property-types.index') }}">
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