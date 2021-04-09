@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">@lang('Password Storage')</li>
            </ol>
        </nav>

        <h1 class="display-5 fw-bold text-center">@lang('My Password Storages')</h1>


        <div id="pm-app" class="mt-4">
            <div>
                <a href="{{route('password.create')}}" class="btn btn-primary">
                    @lang('Add new Password')
                </a>
            </div>

            <div class="row align-items-md-stretch mt-4">
                @forelse($passwords as $password)
                    <div class="col-md-3">
                        <div class="h-100 p-5 text-white bg-dark rounded-3">
                            <h2>{{$password->label}}</h2>
                            <p>
                                {{$password->description}}
                            </p>

                            <a href="{{route('password.show', [$password])}}" class="btn btn-outline-light" type="button">
                                @lang('View Password')
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center">
                        @lang('No password has been saved here yet!')
                    </p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
