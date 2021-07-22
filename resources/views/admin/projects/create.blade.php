@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.projects.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.project.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                            <label class="required" for="slug">{{ trans('cruds.project.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                            @if($errors->has('slug'))
                                <span class="help-block" role="alert">{{ $errors->first('slug') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.project.fields.type') }}</label>
                            <select class="form-control" name="type" id="type">
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Project::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_featured" style="font-weight: 400">{{ trans('cruds.project.fields.is_featured') }}</label>
                            </div>
                            @if($errors->has('is_featured'))
                                <span class="help-block" role="alert">{{ $errors->first('is_featured') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.is_featured_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_premium') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_premium" value="0">
                                <input type="checkbox" name="is_premium" id="is_premium" value="1" {{ old('is_premium', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_premium" style="font-weight: 400">{{ trans('cruds.project.fields.is_premium') }}</label>
                            </div>
                            @if($errors->has('is_premium'))
                                <span class="help-block" role="alert">{{ $errors->first('is_premium') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.is_premium_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('except') ? 'has-error' : '' }}">
                            <label for="except">{{ trans('cruds.project.fields.except') }}</label>
                            <textarea class="form-control" name="except" id="except">{{ old('except') }}</textarea>
                            @if($errors->has('except'))
                                <span class="help-block" role="alert">{{ $errors->first('except') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.except_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="content">{{ trans('cruds.project.fields.content') }}</label>
                            <textarea class="form-control ckeditor" name="content" id="content">{!! old('content') !!}</textarea>
                            @if($errors->has('content'))
                                <span class="help-block" role="alert">{{ $errors->first('content') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('picture_image') ? 'has-error' : '' }}">
                            <label for="picture_image">{{ trans('cruds.project.fields.picture_image') }}</label>
                            <div class="needsclick dropzone" id="picture_image-dropzone">
                            </div>
                            @if($errors->has('picture_image'))
                                <span class="help-block" role="alert">{{ $errors->first('picture_image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.picture_image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('gallery_images') ? 'has-error' : '' }}">
                            <label for="gallery_images">{{ trans('cruds.project.fields.gallery_images') }}</label>
                            <div class="needsclick dropzone" id="gallery_images-dropzone">
                            </div>
                            @if($errors->has('gallery_images'))
                                <span class="help-block" role="alert">{{ $errors->first('gallery_images') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.gallery_images_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                            <label for="country_id">{{ trans('cruds.project.fields.country') }}</label>
                            <select class="form-control select2" name="country_id" id="country_id">
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <span class="help-block" role="alert">{{ $errors->first('country') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                            <label for="state_id">{{ trans('cruds.project.fields.state') }}</label>
                            <select class="form-control select2" name="state_id" id="state_id">
                                @foreach($states as $id => $entry)
                                    <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <span class="help-block" role="alert">{{ $errors->first('state') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city_id">{{ trans('cruds.project.fields.city') }}</label>
                            <select class="form-control select2" name="city_id" id="city_id">
                                @foreach($cities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('property_location') ? 'has-error' : '' }}">
                            <label for="property_location">{{ trans('cruds.project.fields.property_location') }}</label>
                            <input class="form-control" type="text" name="property_location" id="property_location" value="{{ old('property_location', '') }}">
                            @if($errors->has('property_location'))
                                <span class="help-block" role="alert">{{ $errors->first('property_location') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.property_location_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('latitude') ? 'has-error' : '' }}">
                            <label for="latitude">{{ trans('cruds.project.fields.latitude') }}</label>
                            <input class="form-control" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                            @if($errors->has('latitude'))
                                <span class="help-block" role="alert">{{ $errors->first('latitude') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.latitude_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('longitude') ? 'has-error' : '' }}">
                            <label for="longitude">{{ trans('cruds.project.fields.longitude') }}</label>
                            <input class="form-control" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                            @if($errors->has('longitude'))
                                <span class="help-block" role="alert">{{ $errors->first('longitude') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.longitude_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label for="price">{{ trans('cruds.project.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('period') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.project.fields.period') }}</label>
                            <select class="form-control" name="period" id="period">
                                <option value disabled {{ old('period', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Project::PERIOD_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('period', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('period'))
                                <span class="help-block" role="alert">{{ $errors->first('period') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('never_expired') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="never_expired" value="0">
                                <input type="checkbox" name="never_expired" id="never_expired" value="1" {{ old('never_expired', 0) == 1 || old('never_expired') === null ? 'checked' : '' }}>
                                <label for="never_expired" style="font-weight: 400">{{ trans('cruds.project.fields.never_expired') }}</label>
                            </div>
                            @if($errors->has('never_expired'))
                                <span class="help-block" role="alert">{{ $errors->first('never_expired') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.never_expired_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('video_url') ? 'has-error' : '' }}">
                            <label for="video_url">{{ trans('cruds.project.fields.video_url') }}</label>
                            <input class="form-control" type="text" name="video_url" id="video_url" value="{{ old('video_url', '') }}">
                            @if($errors->has('video_url'))
                                <span class="help-block" role="alert">{{ $errors->first('video_url') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.video_url_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('video_thumb') ? 'has-error' : '' }}">
                            <label for="video_thumb">{{ trans('cruds.project.fields.video_thumb') }}</label>
                            <div class="needsclick dropzone" id="video_thumb-dropzone">
                            </div>
                            @if($errors->has('video_thumb'))
                                <span class="help-block" role="alert">{{ $errors->first('video_thumb') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.video_thumb_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('property_features') ? 'has-error' : '' }}">
                            <label for="property_features_id">{{ trans('cruds.project.fields.property_features') }}</label>
                            <select class="form-control select2" name="property_features_id" id="property_features_id">
                                @foreach($property_features as $id => $entry)
                                    <option value="{{ $id }}" {{ old('property_features_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_features'))
                                <span class="help-block" role="alert">{{ $errors->first('property_features') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.property_features_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('property_type') ? 'has-error' : '' }}">
                            <label for="property_type_id">{{ trans('cruds.project.fields.property_type') }}</label>
                            <select class="form-control select2" name="property_type_id" id="property_type_id">
                                @foreach($property_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('property_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_type'))
                                <span class="help-block" role="alert">{{ $errors->first('property_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.property_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('features') ? 'has-error' : '' }}">
                            <label for="features">{{ trans('cruds.project.fields.features') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="features[]" id="features" multiple>
                                @foreach($features as $id => $features)
                                    <option value="{{ $id }}" {{ in_array($id, old('features', [])) ? 'selected' : '' }}>{{ $features }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('features'))
                                <span class="help-block" role="alert">{{ $errors->first('features') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.features_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('facilities') ? 'has-error' : '' }}">
                            <label for="facilities">{{ trans('cruds.project.fields.facilities') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="facilities[]" id="facilities" multiple>
                                @foreach($facilities as $id => $facilities)
                                    <option value="{{ $id }}" {{ in_array($id, old('facilities', [])) ? 'selected' : '' }}>{{ $facilities }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('facilities'))
                                <span class="help-block" role="alert">{{ $errors->first('facilities') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.facilities_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('distance_between_facilities') ? 'has-error' : '' }}">
                            <label for="distance_between_facilities">{{ trans('cruds.project.fields.distance_between_facilities') }}</label>
                            <input class="form-control" type="text" name="distance_between_facilities" id="distance_between_facilities" value="{{ old('distance_between_facilities', '') }}">
                            @if($errors->has('distance_between_facilities'))
                                <span class="help-block" role="alert">{{ $errors->first('distance_between_facilities') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.distance_between_facilities_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('number_blocks') ? 'has-error' : '' }}">
                            <label for="number_blocks">{{ trans('cruds.project.fields.number_blocks') }}</label>
                            <input class="form-control" type="number" name="number_blocks" id="number_blocks" value="{{ old('number_blocks', '') }}" step="1">
                            @if($errors->has('number_blocks'))
                                <span class="help-block" role="alert">{{ $errors->first('number_blocks') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.number_blocks_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('number_floors') ? 'has-error' : '' }}">
                            <label for="number_floors">{{ trans('cruds.project.fields.number_floors') }}</label>
                            <input class="form-control" type="number" name="number_floors" id="number_floors" value="{{ old('number_floors', '') }}" step="1">
                            @if($errors->has('number_floors'))
                                <span class="help-block" role="alert">{{ $errors->first('number_floors') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.number_floors_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('number_flats') ? 'has-error' : '' }}">
                            <label for="number_flats">{{ trans('cruds.project.fields.number_flats') }}</label>
                            <input class="form-control" type="number" name="number_flats" id="number_flats" value="{{ old('number_flats', '') }}" step="1">
                            @if($errors->has('number_flats'))
                                <span class="help-block" role="alert">{{ $errors->first('number_flats') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.number_flats_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lowest_price') ? 'has-error' : '' }}">
                            <label for="lowest_price">{{ trans('cruds.project.fields.lowest_price') }}</label>
                            <input class="form-control" type="number" name="lowest_price" id="lowest_price" value="{{ old('lowest_price', '') }}" step="0.01">
                            @if($errors->has('lowest_price'))
                                <span class="help-block" role="alert">{{ $errors->first('lowest_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.lowest_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('currency') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.project.fields.currency') }}</label>
                            <select class="form-control" name="currency" id="currency">
                                <option value disabled {{ old('currency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Project::CURRENCY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('currency', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <span class="help-block" role="alert">{{ $errors->first('currency') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('max_price') ? 'has-error' : '' }}">
                            <label for="max_price">{{ trans('cruds.project.fields.max_price') }}</label>
                            <input class="form-control" type="number" name="max_price" id="max_price" value="{{ old('max_price', '') }}" step="0.01">
                            @if($errors->has('max_price'))
                                <span class="help-block" role="alert">{{ $errors->first('max_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.max_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                            <label for="meta_title">{{ trans('cruds.project.fields.meta_title') }}</label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', '') }}">
                            @if($errors->has('meta_title'))
                                <span class="help-block" role="alert">{{ $errors->first('meta_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.meta_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                            <label for="meta_description">{{ trans('cruds.project.fields.meta_description') }}</label>
                            <textarea class="form-control" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                            @if($errors->has('meta_description'))
                                <span class="help-block" role="alert">{{ $errors->first('meta_description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.meta_description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : '' }}">
                            <label for="meta_keywords">{{ trans('cruds.project.fields.meta_keywords') }}</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
                            @if($errors->has('meta_keywords'))
                                <span class="help-block" role="alert">{{ $errors->first('meta_keywords') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.meta_keywords_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('investors') ? 'has-error' : '' }}">
                            <label for="investors_id">{{ trans('cruds.project.fields.investors') }}</label>
                            <select class="form-control select2" name="investors_id" id="investors_id">
                                @foreach($investors as $id => $entry)
                                    <option value="{{ $id }}" {{ old('investors_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('investors'))
                                <span class="help-block" role="alert">{{ $errors->first('investors') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.investors_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('finish_date') ? 'has-error' : '' }}">
                            <label for="finish_date">{{ trans('cruds.project.fields.finish_date') }}</label>
                            <input class="form-control datetime" type="text" name="finish_date" id="finish_date" value="{{ old('finish_date') }}">
                            @if($errors->has('finish_date'))
                                <span class="help-block" role="alert">{{ $errors->first('finish_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.finish_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('open_sell_date') ? 'has-error' : '' }}">
                            <label for="open_sell_date">{{ trans('cruds.project.fields.open_sell_date') }}</label>
                            <input class="form-control datetime" type="text" name="open_sell_date" id="open_sell_date" value="{{ old('open_sell_date') }}">
                            @if($errors->has('open_sell_date'))
                                <span class="help-block" role="alert">{{ $errors->first('open_sell_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.open_sell_date_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.projects.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $project->id ?? 0 }}');
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
    url: '{{ route('admin.projects.storeMedia') }}',
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
@if(isset($project) && $project->picture_image)
      var file = {!! json_encode($project->picture_image) !!}
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
    url: '{{ route('admin.projects.storeMedia') }}',
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
@if(isset($project) && $project->gallery_images)
      var files = {!! json_encode($project->gallery_images) !!}
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
    url: '{{ route('admin.projects.storeMedia') }}',
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
@if(isset($project) && $project->video_thumb)
      var file = {!! json_encode($project->video_thumb) !!}
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