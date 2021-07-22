@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.state.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.states.update", [$state->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.state.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $state->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.state.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="slug">{{ trans('cruds.state.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $state->slug) }}" required>
                            @if($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.state.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="country_id">{{ trans('cruds.state.fields.country') }}</label>
                            <select class="form-control select2" name="country_id" id="country_id" required>
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $state->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.state.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="order">{{ trans('cruds.state.fields.order') }}</label>
                            <input class="form-control" type="number" name="order" id="order" value="{{ old('order', $state->order) }}" step="1" required>
                            @if($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.state.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.state.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\State::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $state->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.state.fields.status_helper') }}</span>
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