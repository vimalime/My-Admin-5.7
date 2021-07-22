@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.courses.update", [$course->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('teacher') ? 'has-error' : '' }}">
                            <label class="required" for="teacher_id">{{ trans('cruds.course.fields.teacher') }}</label>
                            <select class="form-control select2" name="teacher_id" id="teacher_id" required>
                                @foreach($teachers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('teacher_id') ? old('teacher_id') : $course->teacher->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('teacher'))
                                <span class="help-block" role="alert">{{ $errors->first('teacher') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.teacher_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.course.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label class="required" for="description">{{ trans('cruds.course.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description" required>{{ old('description', $course->description) }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label for="price">{{ trans('cruds.course.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $course->price) }}" step="0.01">
                            @if($errors->has('price'))
                                <span class="help-block" role="alert">{{ $errors->first('price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
                            <label for="thumbnail">{{ trans('cruds.course.fields.thumbnail') }}</label>
                            <div class="needsclick dropzone" id="thumbnail-dropzone">
                            </div>
                            @if($errors->has('thumbnail'))
                                <span class="help-block" role="alert">{{ $errors->first('thumbnail') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.thumbnail_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_published') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_published" value="0">
                                <input type="checkbox" name="is_published" id="is_published" value="1" {{ $course->is_published || old('is_published', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_published" style="font-weight: 400">{{ trans('cruds.course.fields.is_published') }}</label>
                            </div>
                            @if($errors->has('is_published'))
                                <span class="help-block" role="alert">{{ $errors->first('is_published') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.is_published_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('students') ? 'has-error' : '' }}">
                            <label for="students">{{ trans('cruds.course.fields.students') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="students[]" id="students" multiple>
                                @foreach($students as $id => $students)
                                    <option value="{{ $id }}" {{ (in_array($id, old('students', [])) || $course->students->contains($id)) ? 'selected' : '' }}>{{ $students }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('students'))
                                <span class="help-block" role="alert">{{ $errors->first('students') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.students_helper') }}</span>
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
    var uploadedThumbnailMap = {}
Dropzone.options.thumbnailDropzone = {
    url: '{{ route('admin.courses.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="thumbnail[]" value="' + response.name + '">')
      uploadedThumbnailMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedThumbnailMap[file.name]
      }
      $('form').find('input[name="thumbnail[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($course) && $course->thumbnail)
      var files = {!! json_encode($course->thumbnail) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="thumbnail[]" value="' + file.file_name + '">')
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
@endsection