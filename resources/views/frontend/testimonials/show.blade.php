@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.testimonial.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.testimonials.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($testimonial->picture_image)
                                            <a href="{{ $testimonial->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $testimonial->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.testimonial.fields.rating') }}
                                    </th>
                                    <td>
                                        {{ $testimonial->rating }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.testimonials.index') }}">
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