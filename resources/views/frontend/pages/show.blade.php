@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.page.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pages.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $page->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $page->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $page->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.except') }}
                                    </th>
                                    <td>
                                        {{ $page->except }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $page->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.is_featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $page->is_featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.is_premium') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $page->is_premium ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($page->picture_image)
                                            <a href="{{ $page->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $page->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($page->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.meta_title') }}
                                    </th>
                                    <td>
                                        {{ $page->meta_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.meta_description') }}
                                    </th>
                                    <td>
                                        {{ $page->meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.meta_keywords') }}
                                    </th>
                                    <td>
                                        {{ $page->meta_keywords }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Page::STATUS_SELECT[$page->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $page->template->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.publish_date') }}
                                    </th>
                                    <td>
                                        {{ $page->publish_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $page->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $page->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $page->deleted_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.page.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $page->created_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pages.index') }}">
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