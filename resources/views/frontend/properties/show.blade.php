@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.property.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.properties.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $property->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $property->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $property->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.is_featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $property->is_featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.is_premium') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $property->is_premium ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.except') }}
                                    </th>
                                    <td>
                                        {{ $property->except }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $property->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($property->picture_image)
                                            <a href="{{ $property->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $property->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($property->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Property::TYPE_SELECT[$property->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $property->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $property->state->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $property->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.property_location') }}
                                    </th>
                                    <td>
                                        {{ $property->property_location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.latitude') }}
                                    </th>
                                    <td>
                                        {{ $property->latitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.longitude') }}
                                    </th>
                                    <td>
                                        {{ $property->longitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.number_bedrooms') }}
                                    </th>
                                    <td>
                                        {{ $property->number_bedrooms }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.number_bathrooms') }}
                                    </th>
                                    <td>
                                        {{ $property->number_bathrooms }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.number_floors') }}
                                    </th>
                                    <td>
                                        {{ $property->number_floors }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.square') }}
                                    </th>
                                    <td>
                                        {{ $property->square }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $property->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.currency') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Property::CURRENCY_SELECT[$property->currency] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.period') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Property::PERIOD_SELECT[$property->period] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.never_expired') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $property->never_expired ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.video_url') }}
                                    </th>
                                    <td>
                                        {{ $property->video_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.video_thumb') }}
                                    </th>
                                    <td>
                                        @if($property->video_thumb)
                                            <a href="{{ $property->video_thumb->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $property->video_thumb->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.property_type') }}
                                    </th>
                                    <td>
                                        {{ $property->property_type->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.property_features') }}
                                    </th>
                                    <td>
                                        {{ $property->property_features->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.facilities') }}
                                    </th>
                                    <td>
                                        {{ $property->facilities->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.distance_between_facilities') }}
                                    </th>
                                    <td>
                                        {{ $property->distance_between_facilities }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.moderation_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Property::MODERATION_STATUS_SELECT[$property->moderation_status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Property::STATUS_SELECT[$property->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.selling_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Property::SELLING_STATUS_SELECT[$property->selling_status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.meta_title') }}
                                    </th>
                                    <td>
                                        {{ $property->meta_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.meta_description') }}
                                    </th>
                                    <td>
                                        {{ $property->meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.meta_keywords') }}
                                    </th>
                                    <td>
                                        {{ $property->meta_keywords }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $property->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.project') }}
                                    </th>
                                    <td>
                                        {{ $property->project->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.author') }}
                                    </th>
                                    <td>
                                        {{ $property->author->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $property->created_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $property->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.property.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $property->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.properties.index') }}">
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