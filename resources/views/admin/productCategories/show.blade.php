@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.productCategory.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.product-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.parent') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->parent->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $productCategory->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ProductCategory::STATUS_SELECT[$productCategory->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($productCategory->picture_image)
                                            <a href="{{ $productCategory->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $productCategory->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($productCategory->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.template') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->template->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->deleted_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.created_by') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->created_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.product-categories.index') }}">
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
                        <a href="#parent_product_categories" aria-controls="parent_product_categories" role="tab" data-toggle="tab">
                            {{ trans('cruds.productCategory.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#category_products" aria-controls="category_products" role="tab" data-toggle="tab">
                            {{ trans('cruds.product.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="parent_product_categories">
                        @includeIf('admin.productCategories.relationships.parentProductCategories', ['productCategories' => $productCategory->parentProductCategories])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="category_products">
                        @includeIf('admin.productCategories.relationships.categoryProducts', ['products' => $productCategory->categoryProducts])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection