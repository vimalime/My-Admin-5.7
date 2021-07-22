@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.testResult.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.test-results.update", [$testResult->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('test') ? 'has-error' : '' }}">
                            <label class="required" for="test_id">{{ trans('cruds.testResult.fields.test') }}</label>
                            <select class="form-control select2" name="test_id" id="test_id" required>
                                @foreach($tests as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('test_id') ? old('test_id') : $testResult->test->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('test'))
                                <span class="help-block" role="alert">{{ $errors->first('test') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testResult.fields.test_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('student') ? 'has-error' : '' }}">
                            <label class="required" for="student_id">{{ trans('cruds.testResult.fields.student') }}</label>
                            <select class="form-control select2" name="student_id" id="student_id" required>
                                @foreach($students as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $testResult->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('student'))
                                <span class="help-block" role="alert">{{ $errors->first('student') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testResult.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                            <label for="score">{{ trans('cruds.testResult.fields.score') }}</label>
                            <input class="form-control" type="number" name="score" id="score" value="{{ old('score', $testResult->score) }}" step="1">
                            @if($errors->has('score'))
                                <span class="help-block" role="alert">{{ $errors->first('score') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.testResult.fields.score_helper') }}</span>
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