@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.career.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.careers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $career->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $career->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $career->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $career->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $career->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.publish_date') }}
                                    </th>
                                    <td>
                                        {{ $career->publish_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $career->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.salary') }}
                                    </th>
                                    <td>
                                        {{ $career->salary }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($career->picture_image)
                                            <a href="{{ $career->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $career->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($career->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Career::STATUS_SELECT[$career->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.meta_title') }}
                                    </th>
                                    <td>
                                        {{ $career->meta_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.meta_description') }}
                                    </th>
                                    <td>
                                        {{ $career->meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.meta_keywords') }}
                                    </th>
                                    <td>
                                        {{ $career->meta_keywords }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $career->created_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $career->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $career->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.career.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $career->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.careers.index') }}">
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