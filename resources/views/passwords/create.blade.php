@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('password.index')}}">@lang('Password Storage')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('Create new Password')</li>
            </ol>
        </nav>

        <h1 class="display-5 fw-bold text-center">@lang('Create new Password')</h1>

        <x-error-message />

        <div id="pm-app" class="mt-4">
            <form action="{{route('password.store')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">@lang('Label')</label>
                    <input type="text" class="form-control" name="label" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('Description')</label>
                    <input type="text" class="form-control" name="description" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('Password')</label>
                    <button class="btn btn-info btn-sm" id="generate-password" type="button">@lang('Generate Password')</button>
                    <input type="text" class="form-control" autocomplete="off" id="password" name="password">
                </div>

                <button class="btn btn-primary">
                    @lang('Add')
                </button>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('load', function ()  {
            document.getElementById('generate-password').addEventListener('click', generatePassword)
        })

        function generatePassword() {
            fetch("{{route('password-management.random-password')}}", {
                method: "GET"
            }).then(function (result) {
                return result.json();
            }).then(function (result) {
                document.getElementById('password').value = result.password
            });
        }
    </script>
@endsection
