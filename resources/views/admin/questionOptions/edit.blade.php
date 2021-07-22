@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.questionOption.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.question-options.update", [$questionOption->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label for="question_id">{{ trans('cruds.questionOption.fields.question') }}</label>
                            <select class="form-control select2" name="question_id" id="question_id">
                                @foreach($questions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('question_id') ? old('question_id') : $questionOption->question->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('question'))
                                <span class="help-block" role="alert">{{ $errors->first('question') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionOption.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option_text') ? 'has-error' : '' }}">
                            <label class="required" for="option_text">{{ trans('cruds.questionOption.fields.option_text') }}</label>
                            <input class="form-control" type="text" name="option_text" id="option_text" value="{{ old('option_text', $questionOption->option_text) }}" required>
                            @if($errors->has('option_text'))
                                <span class="help-block" role="alert">{{ $errors->first('option_text') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionOption.fields.option_text_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_correct') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_correct" value="0">
                                <input type="checkbox" name="is_correct" id="is_correct" value="1" {{ $questionOption->is_correct || old('is_correct', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_correct" style="font-weight: 400">{{ trans('cruds.questionOption.fields.is_correct') }}</label>
                            </div>
                            @if($errors->has('is_correct'))
                                <span class="help-block" role="alert">{{ $errors->first('is_correct') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionOption.fields.is_correct_helper') }}</span>
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