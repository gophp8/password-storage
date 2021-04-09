@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">@lang('Password Management Installation')</h1>
                <p class="col-md-8 fs-4">
                    @lang("Let's setup a Master Password and a Backup Password in order to use this application.")
                </p>

                <ul>
                    <li>@lang("Master Password"): @lang('Use to login into the system.')</li>
                    <li>@lang("Backup Password"): @lang('Use to change your password if you ever forget it.')</li>
                </ul>

                <x-error-message />

                <form action="{{route('install')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>@lang("Master Password")</label>
                                <input type="password" name="master_password" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>@lang("Retype Master Password")</label>
                                <input type="password" name="retype_master_password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label>@lang("Backup Password")</label>
                                <input type="password" name="backup_password" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>@lang("Retype Backup Password")</label>
                                <input type="password" name="retype_backup_password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button class="btn btn-primary">
                            @lang("Set Up")
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
