@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.questions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('test') ? 'has-error' : '' }}">
                            <label for="test_id">{{ trans('cruds.question.fields.test') }}</label>
                            <select class="form-control select2" name="test_id" id="test_id">
                                @foreach($tests as $id => $entry)
                                    <option value="{{ $id }}" {{ old('test_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('test'))
                                <span class="help-block" role="alert">{{ $errors->first('test') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.test_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('question_text') ? 'has-error' : '' }}">
                            <label class="required" for="question_text">{{ trans('cruds.question.fields.question_text') }}</label>
                            <input class="form-control" type="text" name="question_text" id="question_text" value="{{ old('question_text', '') }}" required>
                            @if($errors->has('question_text'))
                                <span class="help-block" role="alert">{{ $errors->first('question_text') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.question_text_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('question_image') ? 'has-error' : '' }}">
                            <label for="question_image">{{ trans('cruds.question.fields.question_image') }}</label>
                            <div class="needsclick dropzone" id="question_image-dropzone">
                            </div>
                            @if($errors->has('question_image'))
                                <span class="help-block" role="alert">{{ $errors->first('question_image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.question_image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
                            <label for="points">{{ trans('cruds.question.fields.points') }}</label>
                            <input class="form-control" type="number" name="points" id="points" value="{{ old('points', '1') }}" step="1">
                            @if($errors->has('points'))
                                <span class="help-block" role="alert">{{ $errors->first('points') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.points_helper') }}</span>
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
    Dropzone.options.questionImageDropzone = {
    url: '{{ route('admin.questions.storeMedia') }}',
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
      $('form').find('input[name="question_image"]').remove()
      $('form').append('<input type="hidden" name="question_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="question_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($question) && $question->question_image)
      var file = {!! json_encode($question->question_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="question_image" value="' + file.file_name + '">')
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