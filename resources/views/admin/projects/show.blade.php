@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.project.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $project->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $project->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $project->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Project::TYPE_SELECT[$project->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.is_featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $project->is_featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.is_premium') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $project->is_premium ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.except') }}
                                    </th>
                                    <td>
                                        {{ $project->except }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $project->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($project->picture_image)
                                            <a href="{{ $project->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $project->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($project->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $project->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $project->state->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $project->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.property_location') }}
                                    </th>
                                    <td>
                                        {{ $project->property_location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.latitude') }}
                                    </th>
                                    <td>
                                        {{ $project->latitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.longitude') }}
                                    </th>
                                    <td>
                                        {{ $project->longitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $project->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.period') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Project::PERIOD_SELECT[$project->period] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.never_expired') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $project->never_expired ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.video_url') }}
                                    </th>
                                    <td>
                                        {{ $project->video_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.video_thumb') }}
                                    </th>
                                    <td>
                                        @if($project->video_thumb)
                                            <a href="{{ $project->video_thumb->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $project->video_thumb->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.property_features') }}
                                    </th>
                                    <td>
                                        {{ $project->property_features->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.property_type') }}
                                    </th>
                                    <td>
                                        {{ $project->property_type->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.features') }}
                                    </th>
                                    <td>
                                        @foreach($project->features as $key => $features)
                                            <span class="label label-info">{{ $features->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.facilities') }}
                                    </th>
                                    <td>
                                        @foreach($project->facilities as $key => $facilities)
                                            <span class="label label-info">{{ $facilities->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.distance_between_facilities') }}
                                    </th>
                                    <td>
                                        {{ $project->distance_between_facilities }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.number_blocks') }}
                                    </th>
                                    <td>
                                        {{ $project->number_blocks }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.number_floors') }}
                                    </th>
                                    <td>
                                        {{ $project->number_floors }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.number_flats') }}
                                    </th>
                                    <td>
                                        {{ $project->number_flats }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.lowest_price') }}
                                    </th>
                                    <td>
                                        {{ $project->lowest_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.currency') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Project::CURRENCY_SELECT[$project->currency] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.max_price') }}
                                    </th>
                                    <td>
                                        {{ $project->max_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.meta_title') }}
                                    </th>
                                    <td>
                                        {{ $project->meta_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.meta_description') }}
                                    </th>
                                    <td>
                                        {{ $project->meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.meta_keywords') }}
                                    </th>
                                    <td>
                                        {{ $project->meta_keywords }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.investors') }}
                                    </th>
                                    <td>
                                        {{ $project->investors->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.finish_date') }}
                                    </th>
                                    <td>
                                        {{ $project->finish_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.open_sell_date') }}
                                    </th>
                                    <td>
                                        {{ $project->open_sell_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $project->created_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $project->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $project->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $project->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#project_properties" aria-controls="project_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#project_link_reviews" aria-controls="project_link_reviews" role="tab" data-toggle="tab">
                            {{ trans('cruds.review.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#project_link_sliders" aria-controls="project_link_sliders" role="tab" data-toggle="tab">
                            {{ trans('cruds.slider.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="project_properties">
                        @includeIf('admin.projects.relationships.projectProperties', ['properties' => $project->projectProperties])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="project_link_reviews">
                        @includeIf('admin.projects.relationships.projectLinkReviews', ['reviews' => $project->projectLinkReviews])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="project_link_sliders">
                        @includeIf('admin.projects.relationships.projectLinkSliders', ['sliders' => $project->projectLinkSliders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection