@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.general.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.generals.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="admin_email">{{ trans('cruds.general.fields.admin_email') }}</label>
                            <input class="form-control" type="text" name="admin_email" id="admin_email" value="{{ old('admin_email', '') }}" required>
                            @if($errors->has('admin_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('admin_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.admin_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="timezone">{{ trans('cruds.general.fields.timezone') }}</label>
                            <input class="form-control" type="text" name="timezone" id="timezone" value="{{ old('timezone', '') }}">
                            @if($errors->has('timezone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('timezone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.timezone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="admin_logo">{{ trans('cruds.general.fields.admin_logo') }}</label>
                            <div class="needsclick dropzone" id="admin_logo-dropzone">
                            </div>
                            @if($errors->has('admin_logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('admin_logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.admin_logo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="admin_favicon">{{ trans('cruds.general.fields.admin_favicon') }}</label>
                            <div class="needsclick dropzone" id="admin_favicon-dropzone">
                            </div>
                            @if($errors->has('admin_favicon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('admin_favicon') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.admin_favicon_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="background_image">{{ trans('cruds.general.fields.background_image') }}</label>
                            <div class="needsclick dropzone" id="background_image-dropzone">
                            </div>
                            @if($errors->has('background_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('background_image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.background_image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="admin_title">{{ trans('cruds.general.fields.admin_title') }}</label>
                            <input class="form-control" type="text" name="admin_title" id="admin_title" value="{{ old('admin_title', '') }}" required>
                            @if($errors->has('admin_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('admin_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.admin_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="google_site_verification">{{ trans('cruds.general.fields.google_site_verification') }}</label>
                            <input class="form-control" type="text" name="google_site_verification" id="google_site_verification" value="{{ old('google_site_verification', '') }}">
                            @if($errors->has('google_site_verification'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('google_site_verification') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.google_site_verification_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="google_analytics">{{ trans('cruds.general.fields.google_analytics') }}</label>
                            <input class="form-control" type="text" name="google_analytics" id="google_analytics" value="{{ old('google_analytics', '') }}">
                            @if($errors->has('google_analytics'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('google_analytics') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.google_analytics_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="analytics_view">{{ trans('cruds.general.fields.analytics_view') }}</label>
                            <input class="form-control" type="text" name="analytics_view" id="analytics_view" value="{{ old('analytics_view', '') }}">
                            @if($errors->has('analytics_view'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('analytics_view') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.general.fields.analytics_view_helper') }}</span>
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
    Dropzone.options.adminLogoDropzone = {
    url: '{{ route('frontend.generals.storeMedia') }}',
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
      $('form').find('input[name="admin_logo"]').remove()
      $('form').append('<input type="hidden" name="admin_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="admin_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($general) && $general->admin_logo)
      var file = {!! json_encode($general->admin_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="admin_logo" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.adminFaviconDropzone = {
    url: '{{ route('frontend.generals.storeMedia') }}',
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
      $('form').find('input[name="admin_favicon"]').remove()
      $('form').append('<input type="hidden" name="admin_favicon" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="admin_favicon"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($general) && $general->admin_favicon)
      var file = {!! json_encode($general->admin_favicon) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="admin_favicon" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.backgroundImageDropzone = {
    url: '{{ route('frontend.generals.storeMedia') }}',
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
      $('form').find('input[name="background_image"]').remove()
      $('form').append('<input type="hidden" name="background_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="background_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($general) && $general->background_image)
      var file = {!! json_encode($general->background_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="background_image" value="' + file.file_name + '">')
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