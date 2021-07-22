@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.permalink.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.permalinks.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="pages">{{ trans('cruds.permalink.fields.pages') }}</label>
                            <input class="form-control" type="text" name="pages" id="pages" value="{{ old('pages', '') }}">
                            @if($errors->has('pages'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pages') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.pages_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="blog_posts">{{ trans('cruds.permalink.fields.blog_posts') }}</label>
                            <input class="form-control" type="text" name="blog_posts" id="blog_posts" value="{{ old('blog_posts', '') }}">
                            @if($errors->has('blog_posts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('blog_posts') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.blog_posts_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="blog_categories">{{ trans('cruds.permalink.fields.blog_categories') }}</label>
                            <input class="form-control" type="text" name="blog_categories" id="blog_categories" value="{{ old('blog_categories', '') }}">
                            @if($errors->has('blog_categories'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('blog_categories') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.blog_categories_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="blog_tags">{{ trans('cruds.permalink.fields.blog_tags') }}</label>
                            <input class="form-control" type="text" name="blog_tags" id="blog_tags" value="{{ old('blog_tags', '') }}">
                            @if($errors->has('blog_tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('blog_tags') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.blog_tags_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="careers">{{ trans('cruds.permalink.fields.careers') }}</label>
                            <input class="form-control" type="text" name="careers" id="careers" value="{{ old('careers', '') }}">
                            @if($errors->has('careers'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('careers') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.careers_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="real_estate_properties">{{ trans('cruds.permalink.fields.real_estate_properties') }}</label>
                            <input class="form-control" type="text" name="real_estate_properties" id="real_estate_properties" value="{{ old('real_estate_properties', '') }}">
                            @if($errors->has('real_estate_properties'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('real_estate_properties') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.real_estate_properties_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="real_estate_property_categories">{{ trans('cruds.permalink.fields.real_estate_property_categories') }}</label>
                            <input class="form-control" type="text" name="real_estate_property_categories" id="real_estate_property_categories" value="{{ old('real_estate_property_categories', '') }}">
                            @if($errors->has('real_estate_property_categories'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('real_estate_property_categories') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.permalink.fields.real_estate_property_categories_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="real_estate_projects">{{ trans('cruds.permalink.fields.real_estate_projects') }}</label>
                            <input class="form-control" type="text" name="real_estate_projects" id="real_estate_projects" value="{{ old('real_estate_projects', '') }}">
                            @if($errors->has('real_estate_projects'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('real_estate_projects') }}
                                </div>
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