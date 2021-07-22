@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.template.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $template->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $template->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $template->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Template::STATUS_SELECT[$template->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $template->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $template->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.template.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $template->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
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
                        <a href="#template_pages" aria-controls="template_pages" role="tab" data-toggle="tab">
                            {{ trans('cruds.page.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#template_product_categories" aria-controls="template_product_categories" role="tab" data-toggle="tab">
                            {{ trans('cruds.productCategory.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#template_product_tags" aria-controls="template_product_tags" role="tab" data-toggle="tab">
                            {{ trans('cruds.productTag.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#template_products" aria-controls="template_products" role="tab" data-toggle="tab">
                            {{ trans('cruds.product.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="template_pages">
                        @includeIf('admin.templates.relationships.templatePages', ['pages' => $template->templatePages])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="template_product_categories">
                        @includeIf('admin.templates.relationships.templateProductCategories', ['productCategories' => $template->templateProductCategories])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="template_product_tags">
                        @includeIf('admin.templates.relationships.templateProductTags', ['productTags' => $template->templateProductTags])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="template_products">
                        @includeIf('admin.templates.relationships.templateProducts', ['products' => $template->templateProducts])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection