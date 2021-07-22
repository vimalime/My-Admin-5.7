@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.slider.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.sliders.update", [$slider->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.slider.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $slider->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title_1">{{ trans('cruds.slider.fields.title_1') }}</label>
                            <textarea class="form-control" name="title_1" id="title_1">{{ old('title_1', $slider->title_1) }}</textarea>
                            @if($errors->has('title_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.title_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title_2">{{ trans('cruds.slider.fields.title_2') }}</label>
                            <input class="form-control" type="text" name="title_2" id="title_2" value="{{ old('title_2', $slider->title_2) }}">
                            @if($errors->has('title_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.title_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="excerpt">{{ trans('cruds.slider.fields.excerpt') }}</label>
                            <input class="form-control" type="text" name="excerpt" id="excerpt" value="{{ old('excerpt', $slider->excerpt) }}">
                            @if($errors->has('excerpt'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('excerpt') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.excerpt_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="page_link_id">{{ trans('cruds.slider.fields.page_link') }}</label>
                            <select class="form-control select2" name="page_link_id" id="page_link_id">
                                @foreach($page_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('page_link_id') ? old('page_link_id') : $slider->page_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('page_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('page_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.page_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_link_id">{{ trans('cruds.slider.fields.product_link') }}</label>
                            <select class="form-control select2" name="product_link_id" id="product_link_id">
                                @foreach($product_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_link_id') ? old('product_link_id') : $slider->product_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.product_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="careers_link_id">{{ trans('cruds.slider.fields.careers_link') }}</label>
                            <select class="form-control select2" name="careers_link_id" id="careers_link_id">
                                @foreach($careers_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('careers_link_id') ? old('careers_link_id') : $slider->careers_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('careers_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('careers_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.careers_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="property_link_id">{{ trans('cruds.slider.fields.property_link') }}</label>
                            <select class="form-control select2" name="property_link_id" id="property_link_id">
                                @foreach($property_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('property_link_id') ? old('property_link_id') : $slider->property_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('property_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.property_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="project_link_id">{{ trans('cruds.slider.fields.project_link') }}</label>
                            <select class="form-control select2" name="project_link_id" id="project_link_id">
                                @foreach($project_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('project_link_id') ? old('project_link_id') : $slider->project_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.project_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="blog_link_id">{{ trans('cruds.slider.fields.blog_link') }}</label>
                            <select class="form-control select2" name="blog_link_id" id="blog_link_id">
                                @foreach($blog_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('blog_link_id') ? old('blog_link_id') : $slider->blog_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('blog_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('blog_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.blog_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="package_link_id">{{ trans('cruds.slider.fields.package_link') }}</label>
                            <select class="form-control select2" name="package_link_id" id="package_link_id">
                                @foreach($package_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('package_link_id') ? old('package_link_id') : $slider->package_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('package_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('package_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.package_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="investor_link_id">{{ trans('cruds.slider.fields.investor_link') }}</label>
                            <select class="form-control select2" name="investor_link_id" id="investor_link_id">
                                @foreach($investor_links as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('investor_link_id') ? old('investor_link_id') : $slider->investor_link->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('investor_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('investor_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.investor_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="slider_image">{{ trans('cruds.slider.fields.slider_image') }}</label>
                            <div class="needsclick dropzone" id="slider_image-dropzone">
                            </div>
                            @if($errors->has('slider_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slider_image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.slider_image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.slider.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', $slider->link) }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.link_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.sliderImageDropzone = {
    url: '{{ route('frontend.sliders.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="slider_image"]').remove()
      $('form').append('<input type="hidden" name="slider_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="slider_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($slider) && $slider->slider_image)
      var file = {!! json_encode($slider->slider_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="slider_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection