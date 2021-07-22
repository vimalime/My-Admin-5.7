@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.review.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.reviews.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $review->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $review->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $review->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.user_name') }}
                                    </th>
                                    <td>
                                        {{ $review->user_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $review->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $review->created_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.page_link') }}
                                    </th>
                                    <td>
                                        {{ $review->page_link->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.user_link') }}
                                    </th>
                                    <td>
                                        {{ $review->user_link->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.product_link') }}
                                    </th>
                                    <td>
                                        {{ $review->product_link->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.careers_link') }}
                                    </th>
                                    <td>
                                        {{ $review->careers_link->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.property_link') }}
                                    </th>
                                    <td>
                                        {{ $review->property_link->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.project_link') }}
                                    </th>
                                    <td>
                                        {{ $review->project_link->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.blog_link') }}
                                    </th>
                                    <td>
                                        {{ $review->blog_link->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.package_link') }}
                                    </th>
                                    <td>
                                        {{ $review->package_link->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.review.fields.investor_link') }}
                                    </th>
                                    <td>
                                        {{ $review->investor_link->title ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.reviews.index') }}">
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