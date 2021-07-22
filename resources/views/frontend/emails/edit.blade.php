@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.email.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.emails.update", [$email->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="email_driver">{{ trans('cruds.email.fields.email_driver') }}</label>
                            <input class="form-control" type="text" name="email_driver" id="email_driver" value="{{ old('email_driver', $email->email_driver) }}">
                            @if($errors->has('email_driver'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_driver') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.email.fields.email_driver_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email_mail_gun_domain">{{ trans('cruds.email.fields.email_mail_gun_domain') }}</label>
                            <input class="form-control" type="text" name="email_mail_gun_domain" id="email_mail_gun_domain" value="{{ old('email_mail_gun_domain', $email->email_mail_gun_domain) }}">
                            @if($errors->has('email_mail_gun_domain'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_mail_gun_domain') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.email.fields.email_mail_gun_domain_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email_mail_gun_endpoint">{{ trans('cruds.email.fields.email_mail_gun_endpoint') }}</label>
                            <input class="form-control" type="text" name="email_mail_gun_endpoint" id="email_mail_gun_endpoint" value="{{ old('email_mail_gun_endpoint', $email->email_mail_gun_endpoint) }}">
                            @if($errors->has('email_mail_gun_endpoint'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_mail_gun_endpoint') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.email.fields.email_mail_gun_endpoint_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email_from_name">{{ trans('cruds.email.fields.email_from_name') }}</label>
                            <input class="form-control" type="text" name="email_from_name" id="email_from_name" value="{{ old('email_from_name', $email->email_from_name) }}">
                            @if($errors->has('email_from_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_from_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.email.fields.email_from_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email_from_address">{{ trans('cruds.email.fields.email_from_address') }}</label>
                            <input class="form-control" type="text" name="email_from_address" id="email_from_address" value="{{ old('email_from_address', $email->email_from_address) }}">
                            @if($errors->has('email_from_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_from_address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.email.fields.email_from_address_helper') }}</span>
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