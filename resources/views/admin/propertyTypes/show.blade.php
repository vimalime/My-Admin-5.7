@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.propertyType.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.property-types.index') }}">
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
                            <a class="btn btn-default" href="{{ route('admin.property-types.index') }}">
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
                        <a href="#property_type_projects" aria-controls="property_type_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#property_type_properties" aria-controls="property_type_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="property_type_projects">
                        @includeIf('admin.propertyTypes.relationships.propertyTypeProjects', ['projects' => $propertyType->propertyTypeProjects])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="property_type_properties">
                        @includeIf('admin.propertyTypes.relationships.propertyTypeProperties', ['properties' => $propertyType->propertyTypeProperties])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection