@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.property.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.properties.update", [$property->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.property.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $property->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="slug">{{ trans('cruds.property.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $property->slug) }}" required>
                            @if($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $property->is_featured || old('is_featured', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_featured">{{ trans('cruds.property.fields.is_featured') }}</label>
                            </div>
                            @if($errors->has('is_featured'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_featured') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.is_featured_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_premium" value="0">
                                <input type="checkbox" name="is_premium" id="is_premium" value="1" {{ $property->is_premium || old('is_premium', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_premium">{{ trans('cruds.property.fields.is_premium') }}</label>
                            </div>
                            @if($errors->has('is_premium'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_premium') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.is_premium_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="except">{{ trans('cruds.property.fields.except') }}</label>
                            <textarea class="form-control" name="except" id="except">{{ old('except', $property->except) }}</textarea>
                            @if($errors->has('except'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('except') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.except_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('cruds.property.fields.content') }}</label>
                            <textarea class="form-control ckeditor" name="content" id="content">{!! old('content', $property->content) !!}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="picture_image">{{ trans('cruds.property.fields.picture_image') }}</label>
                            <div class="needsclick dropzone" id="picture_image-dropzone">
                            </div>
                            @if($errors->has('picture_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('picture_image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.picture_image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gallery_images">{{ trans('cruds.property.fields.gallery_images') }}</label>
                            <div class="needsclick dropzone" id="gallery_images-dropzone">
                            </div>
                            @if($errors->has('gallery_images'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gallery_images') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.gallery_images_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.property.fields.type') }}</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Property::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', $property->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="country_id">{{ trans('cruds.property.fields.country') }}</label>
                            <select class="form-control select2" name="country_id" id="country_id">
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $property->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="state_id">{{ trans('cruds.property.fields.state') }}</label>
                            <select class="form-control select2" name="state_id" id="state_id">
                                @foreach($states as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $property->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="city_id">{{ trans('cruds.property.fields.city') }}</label>
                            <select class="form-control select2" name="city_id" id="city_id">
                                @foreach($cities as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $property->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="property_location">{{ trans('cruds.property.fields.property_location') }}</label>
                            <input class="form-control" type="text" name="property_location" id="property_location" value="{{ old('property_location', $property->property_location) }}">
                            @if($errors->has('property_location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('property_location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.property_location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="latitude">{{ trans('cruds.property.fields.latitude') }}</label>
                            <input class="form-control" type="text" name="latitude" id="latitude" value="{{ old('latitude', $property->latitude) }}">
                            @if($errors->has('latitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('latitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.latitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="longitude">{{ trans('cruds.property.fields.longitude') }}</label>
                            <input class="form-control" type="text" name="longitude" id="longitude" value="{{ old('longitude', $property->longitude) }}">
                            @if($errors->has('longitude'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('longitude') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.longitude_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="number_bedrooms">{{ trans('cruds.property.fields.number_bedrooms') }}</label>
                            <input class="form-control" type="number" name="number_bedrooms" id="number_bedrooms" value="{{ old('number_bedrooms', $property->number_bedrooms) }}" step="1">
                            @if($errors->has('number_bedrooms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_bedrooms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.number_bedrooms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="number_bathrooms">{{ trans('cruds.property.fields.number_bathrooms') }}</label>
                            <input class="form-control" type="number" name="number_bathrooms" id="number_bathrooms" value="{{ old('number_bathrooms', $property->number_bathrooms) }}" step="1">
                            @if($errors->has('number_bathrooms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_bathrooms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.number_bathrooms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="number_floors">{{ trans('cruds.property.fields.number_floors') }}</label>
                            <input class="form-control" type="number" name="number_floors" id="number_floors" value="{{ old('number_floors', $property->number_floors) }}" step="1">
                            @if($errors->has('number_floors'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_floors') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.number_floors_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="square">{{ trans('cruds.property.fields.square') }}</label>
                            <input class="form-control" type="number" name="square" id="square" value="{{ old('square', $property->square) }}" step="0.01">
                            @if($errors->has('square'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('square') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.square_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.property.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $property->price) }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.property.fields.currency') }}</label>
                            <select class="form-control" name="currency" id="currency">
                                <option value disabled {{ old('currency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Property::CURRENCY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('currency', $property->currency) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.property.fields.period') }}</label>
                            <select class="form-control" name="period" id="period">
                                <option value disabled {{ old('period', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Property::PERIOD_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('period', $property->period) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="never_expired" value="0">
                                <input type="checkbox" name="never_expired" id="never_expired" value="1" {{ $property->never_expired || old('never_expired', 0) === 1 ? 'checked' : '' }}>
                                <label for="never_expired">{{ trans('cruds.property.fields.never_expired') }}</label>
                            </div>
                            @if($errors->has('never_expired'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('never_expired') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.never_expired_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="video_url">{{ trans('cruds.property.fields.video_url') }}</label>
                            <input class="form-control" type="text" name="video_url" id="video_url" value="{{ old('video_url', $property->video_url) }}">
                            @if($errors->has('video_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('video_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.video_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="video_thumb">{{ trans('cruds.property.fields.video_thumb') }}</label>
                            <div class="needsclick dropzone" id="video_thumb-dropzone">
                            </div>
                            @if($errors->has('video_thumb'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('video_thumb') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.video_thumb_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="property_type_id">{{ trans('cruds.property.fields.property_type') }}</label>
                            <select class="form-control select2" name="property_type_id" id="property_type_id">
                                @foreach($property_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('property_type_id') ? old('property_type_id') : $property->property_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('property_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.property_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="property_features_id">{{ trans('cruds.property.fields.property_features') }}</label>
                            <select class="form-control select2" name="property_features_id" id="property_features_id">
                                @foreach($property_features as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('property_features_id') ? old('property_features_id') : $property->property_features->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_features'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('property_features') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.property_features_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="facilities_id">{{ trans('cruds.property.fields.facilities') }}</label>
                            <select class="form-control select2" name="facilities_id" id="facilities_id">
                                @foreach($facilities as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('facilities_id') ? old('facilities_id') : $property->facilities->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('facilities'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facilities') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.facilities_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="distance_between_facilities">{{ trans('cruds.property.fields.distance_between_facilities') }}</label>
                            <input class="form-control" type="text" name="distance_between_facilities" id="distance_between_facilities" value="{{ old('distance_between_facilities', $property->distance_between_facilities) }}">
                            @if($errors->has('distance_between_facilities'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('distance_between_facilities') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.distance_between_facilities_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.property.fields.moderation_status') }}</label>
                            <select class="form-control" name="moderation_status" id="moderation_status" required>
                                <option value disabled {{ old('moderation_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Property::MODERATION_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('moderation_status', $property->moderation_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('moderation_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('moderation_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.moderation_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.property.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Property::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $property->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.property.fields.selling_status') }}</label>
                            <select class="form-control" name="selling_status" id="selling_status">
                                <option value disabled {{ old('selling_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Property::SELLING_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('selling_status', $property->selling_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('selling_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('selling_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.selling_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">{{ trans('cruds.property.fields.meta_title') }}</label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $property->meta_title) }}">
                            @if($errors->has('meta_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.meta_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">{{ trans('cruds.property.fields.meta_description') }}</label>
                            <textarea class="form-control" name="meta_description" id="meta_description">{{ old('meta_description', $property->meta_description) }}</textarea>
                            @if($errors->has('meta_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.meta_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">{{ trans('cruds.property.fields.meta_keywords') }}</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords', $property->meta_keywords) }}</textarea>
                            @if($errors->has('meta_keywords'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_keywords') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.meta_keywords_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="project_id">{{ trans('cruds.property.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id">
                                @foreach($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $property->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="author_id">{{ trans('cruds.property.fields.author') }}</label>
                            <select class="form-control select2" name="author_id" id="author_id">
                                @foreach($authors as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $property->author->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('author'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('author') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.property.fields.author_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.properties.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $property->id ?? 0 }}');
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

<script>
    Dropzone.options.pictureImageDropzone = {
    url: '{{ route('frontend.properties.storeMedia') }}',
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
@if(isset($property) && $property->picture_image)
      var file = {!! json_encode($property->picture_image) !!}
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
<script>
    var uploadedGalleryImagesMap = {}
Dropzone.options.galleryImagesDropzone = {
    url: '{{ route('frontend.properties.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="gallery_images[]" value="' + response.name + '">')
      uploadedGalleryImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGalleryImagesMap[file.name]
      }
      $('form').find('input[name="gallery_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($property) && $property->gallery_images)
      var files = {!! json_encode($property->gallery_images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="gallery_images[]" value="' + file.file_name + '">')
        }
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
    Dropzone.options.videoThumbDropzone = {
    url: '{{ route('frontend.properties.storeMedia') }}',
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
      $('form').find('input[name="video_thumb"]').remove()
      $('form').append('<input type="hidden" name="video_thumb" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="video_thumb"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($property) && $property->video_thumb)
      var file = {!! json_encode($property->video_thumb) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="video_thumb" value="' + file.file_name + '">')
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