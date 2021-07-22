@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.propertyFeature.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.property-features.index') }}">
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
                            <a class="btn btn-default" href="{{ route('admin.property-features.index') }}">
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
                        <a href="#property_features_projects" aria-controls="property_features_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#property_features_properties" aria-controls="property_features_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#features_projects" aria-controls="features_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="property_features_projects">
                        @includeIf('admin.propertyFeatures.relationships.propertyFeaturesProjects', ['projects' => $propertyFeature->propertyFeaturesProjects])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="property_features_properties">
                        @includeIf('admin.propertyFeatures.relationships.propertyFeaturesProperties', ['properties' => $propertyFeature->propertyFeaturesProperties])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="features_projects">
                        @includeIf('admin.propertyFeatures.relationships.featuresProjects', ['projects' => $propertyFeature->featuresProjects])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection