@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.email.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.emails.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $email->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.email_driver') }}
                                    </th>
                                    <td>
                                        {{ $email->email_driver }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.email_mail_gun_domain') }}
                                    </th>
                                    <td>
                                        {{ $email->email_mail_gun_domain }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.email_mail_gun_endpoint') }}
                                    </th>
                                    <td>
                                        {{ $email->email_mail_gun_endpoint }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.email_from_name') }}
                                    </th>
                                    <td>
                                        {{ $email->email_from_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.email_from_address') }}
                                    </th>
                                    <td>
                                        {{ $email->email_from_address }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.emails.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection