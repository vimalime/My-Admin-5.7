@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.package.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.packages.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.package.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                            <label class="required" for="slug">{{ trans('cruds.package.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                            @if($errors->has('slug'))
                                <span class="help-block" role="alert">{{ $errors->first('slug') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('except') ? 'has-error' : '' }}">
                            <label for="except">{{ trans('cruds.package.fields.except') }}</label>
                            <textarea class="form-control" name="except" id="except">{{ old('except') }}</textarea>
                            @if($errors->has('except'))
                                <span class="help-block" role="alert">{{ $errors->first('except') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.except_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="content">{{ trans('cruds.package.fields.content') }}</label>
                            <textarea class="form-control ckeditor" name="content" id="content">{!! old('content') !!}</textarea>
                            @if($errors->has('content'))
                                <span class="help-block" role="alert">{{ $errors->first('content') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_featured" style="font-weight: 400">{{ trans('cruds.package.fields.is_featured') }}</label>
                            </div>
                            @if($errors->has('is_featured'))
                                <span class="help-block" role="alert">{{ $errors->first('is_featured') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.is_featured_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_premium') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_premium" value="0">
                                <input type="checkbox" name="is_premium" id="is_premium" value="1" {{ old('is_premium', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_premium" style="font-weight: 400">{{ trans('cruds.package.fields.is_premium') }}</label>
                            </div>
                            @if($errors->has('is_premium'))
                                <span class="help-block" role="alert">{{ $errors->first('is_premium') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.is_premium_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label for="price">{{ trans('cruds.package.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('post_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.package.fields.post_status') }}</label>
                            <select class="form-control" name="post_status" id="post_status" required>
                                <option value disabled {{ old('post_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Package::POST_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('post_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('post_status'))
                                <span class="help-block" role="alert">{{ $errors->first('post_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.post_status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('currency') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.package.fields.currency') }}</label>
                            <select class="form-control" name="currency" id="currency">
                                <option value disabled {{ old('currency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Package::CURRENCY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('currency', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <span class="help-block" role="alert">{{ $errors->first('currency') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
                            <label for="order">{{ trans('cruds.package.fields.order') }}</label>
                            <input class="form-control" type="number" name="order" id="order" value="{{ old('order', '0') }}" step="1">
                            @if($errors->has('order'))
                                <span class="help-block" role="alert">{{ $errors->first('order') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('percent_save') ? 'has-error' : '' }}">
                            <label for="percent_save">{{ trans('cruds.package.fields.percent_save') }}</label>
                            <input class="form-control" type="number" name="percent_save" id="percent_save" value="{{ old('percent_save', '') }}" step="0.01" max="100">
                            @if($errors->has('percent_save'))
                                <span class="help-block" role="alert">{{ $errors->first('percent_save') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.percent_save_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('number_of_listings') ? 'has-error' : '' }}">
                            <label for="number_of_listings">{{ trans('cruds.package.fields.number_of_listings') }}</label>
                            <input class="form-control" type="number" name="number_of_listings" id="number_of_listings" value="{{ old('number_of_listings', '0') }}" step="1">
                            @if($errors->has('number_of_listings'))
                                <span class="help-block" role="alert">{{ $errors->first('number_of_listings') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.number_of_listings_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('limit_purchase_by_account') ? 'has-error' : '' }}">
                            <label for="limit_purchase_by_account">{{ trans('cruds.package.fields.limit_purchase_by_account') }}</label>
                            <input class="form-control" type="number" name="limit_purchase_by_account" id="limit_purchase_by_account" value="{{ old('limit_purchase_by_account', '0') }}" step="1">
                            @if($errors->has('limit_purchase_by_account'))
                                <span class="help-block" role="alert">{{ $errors->first('limit_purchase_by_account') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.limit_purchase_by_account_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_default') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_default" value="0">
                                <input type="checkbox" name="is_default" id="is_default" value="1" {{ old('is_default', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_default" style="font-weight: 400">{{ trans('cruds.package.fields.is_default') }}</label>
                            </div>
                            @if($errors->has('is_default'))
                                <span class="help-block" role="alert">{{ $errors->first('is_default') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.is_default_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('publish_date') ? 'has-error' : '' }}">
                            <label class="required" for="publish_date">{{ trans('cruds.package.fields.publish_date') }}</label>
                            <input class="form-control datetime" type="text" name="publish_date" id="publish_date" value="{{ old('publish_date') }}" required>
                            @if($errors->has('publish_date'))
                                <span class="help-block" role="alert">{{ $errors->first('publish_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.publish_date_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.packages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $package->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection