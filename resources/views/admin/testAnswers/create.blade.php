@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.testAnswer.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.test-answers.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('test_result') ? 'has-error' : '' }}">
                            <label class="required" for="test_result_id">{{ trans('cruds.testAnswer.fields.test_result') }}</label>
                            <select class="form-control select2" name="test_result_id" id="test_result_id" required>
                                @foreach($test_results as $id => $entry)
                                    <option value="{{ $id }}" {{ old('test_result_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('test_result'))
                                <span class="help-block" role="alert">{{ $errors->first('test_result') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testAnswer.fields.test_result_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label class="required" for="question_id">{{ trans('cruds.testAnswer.fields.question') }}</label>
                            <select class="form-control select2" name="question_id" id="question_id" required>
                                @foreach($questions as $id => $entry)
                                    <option value="{{ $id }}" {{ old('question_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('question'))
                                <span class="help-block" role="alert">{{ $errors->first('question') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testAnswer.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option') ? 'has-error' : '' }}">
                            <label class="required" for="option_id">{{ trans('cruds.testAnswer.fields.option') }}</label>
                            <select class="form-control select2" name="option_id" id="option_id" required>
                                @foreach($options as $id => $entry)
                                    <option value="{{ $id }}" {{ old('option_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('option'))
                                <span class="help-block" role="alert">{{ $errors->first('option') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testAnswer.fields.option_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('is_correct') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="is_correct" value="0">
                                <input type="checkbox" name="is_correct" id="is_correct" value="1" {{ old('is_correct', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_correct" style="font-weight: 400">{{ trans('cruds.testAnswer.fields.is_correct') }}</label>
                            </div>
                            @if($errors->has('is_correct'))
                                <span class="help-block" role="alert">{{ $errors->first('is_correct') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testAnswer.fields.is_correct_helper') }}</span>
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