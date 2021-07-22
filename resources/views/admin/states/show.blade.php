@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.state.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.states.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $state->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $state->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $state->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $state->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.order') }}
                                    </th>
                                    <td>
                                        {{ $state->order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\State::STATUS_SELECT[$state->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $state->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $state->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.state.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $state->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.states.index') }}">
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
                        <a href="#state_cities" aria-controls="state_cities" role="tab" data-toggle="tab">
                            {{ trans('cruds.city.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#state_users" aria-controls="state_users" role="tab" data-toggle="tab">
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#state_projects" aria-controls="state_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#state_properties" aria-controls="state_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="state_cities">
                        @includeIf('admin.states.relationships.stateCities', ['cities' => $state->stateCities])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="state_users">
                        @includeIf('admin.states.relationships.stateUsers', ['users' => $state->stateUsers])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="state_projects">
                        @includeIf('admin.states.relationships.stateProjects', ['projects' => $state->stateProjects])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="state_properties">
                        @includeIf('admin.states.relationships.stateProperties', ['properties' => $state->stateProperties])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection