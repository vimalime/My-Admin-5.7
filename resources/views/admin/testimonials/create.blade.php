@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.testimonial.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.testimonials.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.testimonial.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                            <label class="required" for="slug">{{ trans('cruds.testimonial.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                            @if($errors->has('slug'))
                                <span class="help-block" role="alert">{{ $errors->first('slug') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('picture_image') ? 'has-error' : '' }}">
                            <label for="picture_image">{{ trans('cruds.testimonial.fields.picture_image') }}</label>
                            <div class="needsclick dropzone" id="picture_image-dropzone">
                            </div>
                            @if($errors->has('picture_image'))
                                <span class="help-block" role="alert">{{ $errors->first('picture_image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.picture_image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label class="required" for="excerpt">{{ trans('cruds.testimonial.fields.excerpt') }}</label>
                            <textarea class="form-control" name="excerpt" id="excerpt" required>{{ old('excerpt') }}</textarea>
                            @if($errors->has('excerpt'))
                                <span class="help-block" role="alert">{{ $errors->first('excerpt') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.excerpt_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                            <label class="required" for="link">{{ trans('cruds.testimonial.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '#') }}" required>
                            @if($errors->has('link'))
                                <span class="help-block" role="alert">{{ $errors->first('link') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('rating') ? 'has-error' : '' }}">
                            <label for="rating">{{ trans('cruds.testimonial.fields.rating') }}</label>
                            <input class="form-control" type="number" name="rating" id="rating" value="{{ old('rating', '0') }}" step="1">
                            @if($errors->has('rating'))
                                <span class="help-block" role="alert">{{ $errors->first('rating') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testimonial.fields.rating_helper') }}</span>
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
    Dropzone.options.pictureImageDropzone = {
    url: '{{ route('admin.testimonials.storeMedia') }}',
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
      $('form').find('input[name="picture_image"]').remove()
      $('form').append('<input type="hidden" name="picture_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="picture_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($testimonial) && $testimonial->picture_image)
      var file = {!! json_encode($testimonial->picture_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="picture_image" value="' + file.file_name + '">')
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