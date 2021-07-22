@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.investor.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.investors.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $investor->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $investor->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $investor->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Investor::STATUS_SELECT[$investor->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $investor->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $investor->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.investor.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $investor->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.investors.index') }}">
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
                        <a href="#investor_link_reviews" aria-controls="investor_link_reviews" role="tab" data-toggle="tab">
                            {{ trans('cruds.review.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#investor_link_sliders" aria-controls="investor_link_sliders" role="tab" data-toggle="tab">
                            {{ trans('cruds.slider.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="investor_link_reviews">
                        @includeIf('admin.investors.relationships.investorLinkReviews', ['reviews' => $investor->investorLinkReviews])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="investor_link_sliders">
                        @includeIf('admin.investors.relationships.investorLinkSliders', ['sliders' => $investor->investorLinkSliders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection