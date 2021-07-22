@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.review.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.reviews.update", [$review->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.review.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $review->title) }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label for="excerpt">{{ trans('cruds.review.fields.excerpt') }}</label>
                            <input class="form-control" type="text" name="excerpt" id="excerpt" value="{{ old('excerpt', $review->excerpt) }}">
                            @if($errors->has('excerpt'))
                                <span class="help-block" role="alert">{{ $errors->first('excerpt') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.excerpt_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                            <label for="user_name">{{ trans('cruds.review.fields.user_name') }}</label>
                            <input class="form-control" type="text" name="user_name" id="user_name" value="{{ old('user_name', $review->user_name) }}">
                            @if($errors->has('user_name'))
                                <span class="help-block" role="alert">{{ $errors->first('user_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.user_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.review.fields.email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email', $review->email) }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
                            <label for="created_by_id">{{ trans('cruds.review.fields.created_by') }}</label>
                            <select class="form-control select2" name="created_by_id" id="created_by_id">
                                @foreach($created_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('created_by_id') ? old('created_by_id') : $review->created_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('created_by'))
                                <span class="help-block" role="alert">{{ $errors->first('created_by') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.created_by_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('page_link') ? 'has-error' : '' }}">
                            <label for="page_link_id">{{ trans('cruds.review.fields.page_link') }}</label>
                            <select class="form-control select2" name="page_link_id" id="page_link_id">
                                @foreach($page_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('page_link_id') ? old('page_link_id') : $review->page_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('page_link'))
                                <span class="help-block" role="alert">{{ $errors->first('page_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.page_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('user_link') ? 'has-error' : '' }}">
                            <label for="user_link_id">{{ trans('cruds.review.fields.user_link') }}</label>
                            <select class="form-control select2" name="user_link_id" id="user_link_id">
                                @foreach($user_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_link_id') ? old('user_link_id') : $review->user_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user_link'))
                                <span class="help-block" role="alert">{{ $errors->first('user_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.user_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('product_link') ? 'has-error' : '' }}">
                            <label for="product_link_id">{{ trans('cruds.review.fields.product_link') }}</label>
                            <select class="form-control select2" name="product_link_id" id="product_link_id">
                                @foreach($product_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_link_id') ? old('product_link_id') : $review->product_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_link'))
                                <span class="help-block" role="alert">{{ $errors->first('product_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.product_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('careers_link') ? 'has-error' : '' }}">
                            <label for="careers_link_id">{{ trans('cruds.review.fields.careers_link') }}</label>
                            <select class="form-control select2" name="careers_link_id" id="careers_link_id">
                                @foreach($careers_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('careers_link_id') ? old('careers_link_id') : $review->careers_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('careers_link'))
                                <span class="help-block" role="alert">{{ $errors->first('careers_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.careers_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('property_link') ? 'has-error' : '' }}">
                            <label for="property_link_id">{{ trans('cruds.review.fields.property_link') }}</label>
                            <select class="form-control select2" name="property_link_id" id="property_link_id">
                                @foreach($property_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('property_link_id') ? old('property_link_id') : $review->property_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_link'))
                                <span class="help-block" role="alert">{{ $errors->first('property_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.property_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('project_link') ? 'has-error' : '' }}">
                            <label for="project_link_id">{{ trans('cruds.review.fields.project_link') }}</label>
                            <select class="form-control select2" name="project_link_id" id="project_link_id">
                                @foreach($project_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('project_link_id') ? old('project_link_id') : $review->project_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project_link'))
                                <span class="help-block" role="alert">{{ $errors->first('project_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.project_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('blog_link') ? 'has-error' : '' }}">
                            <label for="blog_link_id">{{ trans('cruds.review.fields.blog_link') }}</label>
                            <select class="form-control select2" name="blog_link_id" id="blog_link_id">
                                @foreach($blog_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('blog_link_id') ? old('blog_link_id') : $review->blog_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('blog_link'))
                                <span class="help-block" role="alert">{{ $errors->first('blog_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.blog_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('package_link') ? 'has-error' : '' }}">
                            <label for="package_link_id">{{ trans('cruds.review.fields.package_link') }}</label>
                            <select class="form-control select2" name="package_link_id" id="package_link_id">
                                @foreach($package_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('package_link_id') ? old('package_link_id') : $review->package_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('package_link'))
                                <span class="help-block" role="alert">{{ $errors->first('package_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.package_link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('investor_link') ? 'has-error' : '' }}">
                            <label for="investor_link_id">{{ trans('cruds.review.fields.investor_link') }}</label>
                            <select class="form-control select2" name="investor_link_id" id="investor_link_id">
                                @foreach($investor_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('investor_link_id') ? old('investor_link_id') : $review->investor_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('investor_link'))
                                <span class="help-block" role="alert">{{ $errors->first('investor_link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.investor_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection