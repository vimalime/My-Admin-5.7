@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.package.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.packages.update", [$package->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.package.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $package->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="slug">{{ trans('cruds.package.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $package->slug) }}" required>
                            @if($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="except">{{ trans('cruds.package.fields.except') }}</label>
                            <textarea class="form-control" name="except" id="except">{{ old('except', $package->except) }}</textarea>
                            @if($errors->has('except'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('except') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.except_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('cruds.package.fields.content') }}</label>
                            <textarea class="form-control ckeditor" name="content" id="content">{!! old('content', $package->content) !!}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $package->is_featured || old('is_featured', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_featured">{{ trans('cruds.package.fields.is_featured') }}</label>
                            </div>
                            @if($errors->has('is_featured'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_featured') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.is_featured_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_premium" value="0">
                                <input type="checkbox" name="is_premium" id="is_premium" value="1" {{ $package->is_premium || old('is_premium', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_premium">{{ trans('cruds.package.fields.is_premium') }}</label>
                            </div>
                            @if($errors->has('is_premium'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_premium') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.is_premium_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.package.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $package->price) }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.package.fields.post_status') }}</label>
                            <select class="form-control" name="post_status" id="post_status" required>
                                <option value disabled {{ old('post_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Package::POST_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('post_status', $package->post_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('post_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('post_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.post_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.package.fields.currency') }}</label>
                            <select class="form-control" name="currency" id="currency">
                                <option value disabled {{ old('currency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Package::CURRENCY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('currency', $package->currency) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order">{{ trans('cruds.package.fields.order') }}</label>
                            <input class="form-control" type="number" name="order" id="order" value="{{ old('order', $package->order) }}" step="1">
                            @if($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="percent_save">{{ trans('cruds.package.fields.percent_save') }}</label>
                            <input class="form-control" type="number" name="percent_save" id="percent_save" value="{{ old('percent_save', $package->percent_save) }}" step="0.01" max="100">
                            @if($errors->has('percent_save'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('percent_save') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.percent_save_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="number_of_listings">{{ trans('cruds.package.fields.number_of_listings') }}</label>
                            <input class="form-control" type="number" name="number_of_listings" id="number_of_listings" value="{{ old('number_of_listings', $package->number_of_listings) }}" step="1">
                            @if($errors->has('number_of_listings'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_of_listings') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.number_of_listings_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="limit_purchase_by_account">{{ trans('cruds.package.fields.limit_purchase_by_account') }}</label>
                            <input class="form-control" type="number" name="limit_purchase_by_account" id="limit_purchase_by_account" value="{{ old('limit_purchase_by_account', $package->limit_purchase_by_account) }}" step="1">
                            @if($errors->has('limit_purchase_by_account'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('limit_purchase_by_account') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.limit_purchase_by_account_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_default" value="0">
                                <input type="checkbox" name="is_default" id="is_default" value="1" {{ $package->is_default || old('is_default', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_default">{{ trans('cruds.package.fields.is_default') }}</label>
                            </div>
                            @if($errors->has('is_default'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_default') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.package.fields.is_default_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="publish_date">{{ trans('cruds.package.fields.publish_date') }}</label>
                            <input class="form-control datetime" type="text" name="publish_date" id="publish_date" value="{{ old('publish_date', $package->publish_date) }}" required>
                            @if($errors->has('publish_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('publish_date') }}
                                </div>
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