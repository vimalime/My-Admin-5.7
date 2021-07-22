@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.package.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.packages.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $package->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $package->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $package->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.except') }}
                                    </th>
                                    <td>
                                        {{ $package->except }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $package->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.is_featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $package->is_featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.is_premium') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $package->is_premium ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $package->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.post_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Package::POST_STATUS_SELECT[$package->post_status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.currency') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Package::CURRENCY_SELECT[$package->currency] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.order') }}
                                    </th>
                                    <td>
                                        {{ $package->order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.percent_save') }}
                                    </th>
                                    <td>
                                        {{ $package->percent_save }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.number_of_listings') }}
                                    </th>
                                    <td>
                                        {{ $package->number_of_listings }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.limit_purchase_by_account') }}
                                    </th>
                                    <td>
                                        {{ $package->limit_purchase_by_account }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.is_default') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $package->is_default ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.publish_date') }}
                                    </th>
                                    <td>
                                        {{ $package->publish_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $package->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $package->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.package.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $package->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.packages.index') }}">
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