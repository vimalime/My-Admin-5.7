@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.permalink.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.permalinks.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('pages') ? 'has-error' : '' }}">
                            <label for="pages">{{ trans('cruds.permalink.fields.pages') }}</label>
                            <input class="form-control" type="text" name="pages" id="pages" value="{{ old('pages', '') }}">
                            @if($errors->has('pages'))
                                <span class="help-block" role="alert">{{ $errors->first('pages') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.pages_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('blog_posts') ? 'has-error' : '' }}">
                            <label for="blog_posts">{{ trans('cruds.permalink.fields.blog_posts') }}</label>
                            <input class="form-control" type="text" name="blog_posts" id="blog_posts" value="{{ old('blog_posts', '') }}">
                            @if($errors->has('blog_posts'))
                                <span class="help-block" role="alert">{{ $errors->first('blog_posts') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.blog_posts_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('blog_categories') ? 'has-error' : '' }}">
                            <label for="blog_categories">{{ trans('cruds.permalink.fields.blog_categories') }}</label>
                            <input class="form-control" type="text" name="blog_categories" id="blog_categories" value="{{ old('blog_categories', '') }}">
                            @if($errors->has('blog_categories'))
                                <span class="help-block" role="alert">{{ $errors->first('blog_categories') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.blog_categories_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('blog_tags') ? 'has-error' : '' }}">
                            <label for="blog_tags">{{ trans('cruds.permalink.fields.blog_tags') }}</label>
                            <input class="form-control" type="text" name="blog_tags" id="blog_tags" value="{{ old('blog_tags', '') }}">
                            @if($errors->has('blog_tags'))
                                <span class="help-block" role="alert">{{ $errors->first('blog_tags') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.blog_tags_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('careers') ? 'has-error' : '' }}">
                            <label for="careers">{{ trans('cruds.permalink.fields.careers') }}</label>
                            <input class="form-control" type="text" name="careers" id="careers" value="{{ old('careers', '') }}">
                            @if($errors->has('careers'))
                                <span class="help-block" role="alert">{{ $errors->first('careers') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.careers_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('real_estate_properties') ? 'has-error' : '' }}">
                            <label for="real_estate_properties">{{ trans('cruds.permalink.fields.real_estate_properties') }}</label>
                            <input class="form-control" type="text" name="real_estate_properties" id="real_estate_properties" value="{{ old('real_estate_properties', '') }}">
                            @if($errors->has('real_estate_properties'))
                                <span class="help-block" role="alert">{{ $errors->first('real_estate_properties') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.real_estate_properties_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('real_estate_property_categories') ? 'has-error' : '' }}">
                            <label for="real_estate_property_categories">{{ trans('cruds.permalink.fields.real_estate_property_categories') }}</label>
                            <input class="form-control" type="text" name="real_estate_property_categories" id="real_estate_property_categories" value="{{ old('real_estate_property_categories', '') }}">
                            @if($errors->has('real_estate_property_categories'))
                                <span class="help-block" role="alert">{{ $errors->first('real_estate_property_categories') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.real_estate_property_categories_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('real_estate_projects') ? 'has-error' : '' }}">
                            <label for="real_estate_projects">{{ trans('cruds.permalink.fields.real_estate_projects') }}</label>
                            <input class="form-control" type="text" name="real_estate_projects" id="real_estate_projects" value="{{ old('real_estate_projects', '') }}">
                            @if($errors->has('real_estate_projects'))
                                <span class="help-block" role="alert">{{ $errors->first('real_estate_projects') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.real_estate_projects_helper') }}</span>
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