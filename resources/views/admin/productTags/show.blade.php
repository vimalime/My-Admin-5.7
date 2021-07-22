@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.productTag.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.product-tags.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productTag->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productTag->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $productTag->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ProductTag::STATUS_SELECT[$productTag->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $productTag->template->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $productTag->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $productTag->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $productTag->deleted_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productTag.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $productTag->created_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.product-tags.index') }}">
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
                        <a href="#tag_products" aria-controls="tag_products" role="tab" data-toggle="tab">
                            {{ trans('cruds.product.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="tag_products">
                        @includeIf('admin.productTags.relationships.tagProducts', ['products' => $productTag->tagProducts])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection