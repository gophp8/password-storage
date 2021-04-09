@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">@lang('Access your Password Storage')</h1>

                <x-error-message />

                <form action="{{route('login.submit')}}" method="POST">
                    @csrf

                    <div class="form-group mt-2">
                        <label class="col-form-label-lg">@lang("Enter your Master Password")</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>

                    <div class="mt-2 text-center">
                        <button class="btn btn-primary">
                            @lang('Access your Storage')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
