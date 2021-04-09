@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('password.index')}}">@lang('Password Storage')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('View Password'): {{$password->label}}</li>
            </ol>
        </nav>

        <x-error-message />

        <div id="pm-app" class="mt-4">
            <form action="{{route('password.update', [$password])}}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">@lang('Label')</label>
                    <input type="text" class="form-control" name="label" autocomplete="off" value="{{$password->label}}">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('Description')</label>
                    <input type="text" class="form-control" name="description" autocomplete="off" value="{{$password->description}}">
                </div>

                <div class="mb-3">
                    <label class="form-label">@lang('Password')</label>

                    <button class="btn btn-danger btn-sm" id="view-password" type="button">@lang('View')</button>
                    <button class="btn btn-info btn-sm disabled" id="generate-password" type="button">@lang('Generate Password')</button>

                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" value="*********">


                    <p class="form-text">@lang('You need to switch to "View" mode to change the password.')</p>
                </div>

                <div>
                    <button class="btn btn-primary">
                        @lang('Update')
                    </button>

                    <button class="btn btn-danger">
                        @lang('Delete')
                    </button>
                </div>
            </form>


            @if (!$password->passwordHistories->isEmpty())
                <hr>

                <div class="mt-4">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#pass-histories-modal">
                        @lang('View Password Histories')
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pass-histories-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Password Histories')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Created At')</th>
                                <th>@lang('Password')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($password->passwordHistories as $passwordHistory)
                                <tr>
                                    <td>
                                        {{$passwordHistory->createdAtDateText}}
                                    </td>
                                    <td>
                                        <code id="placeholder-{{$passwordHistory->id}}">
                                            ******
                                        </code>
                                        <code id="raw-{{$passwordHistory->id}}" class="d-none">
                                            {{$passwordHistory->rawPassword}}
                                        </code>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="return showHistoryPassword({{$passwordHistory->id}});">
                                            @lang('View')
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function ()  {
            document.getElementById('generate-password').addEventListener('click', generatePassword)
            document.getElementById('view-password').addEventListener('click', viewPassword)
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

        function viewPassword(e) {
            var rawPassword = atob("{{base64_encode($password->rawPassword)}}")
            var inputPassword = document.getElementById('password')

            if (inputPassword.type == 'password') {
                inputPassword.type = 'text'
                inputPassword.value = rawPassword

                document.getElementById('generate-password').classList.remove('disabled')
                e.target.innerText = '@lang('Hide')'
            } else {
                inputPassword.type = 'password'
                inputPassword.value = "*********"

                document.getElementById('generate-password').classList.add('disabled')
                e.target.innerText = '@lang('View')'
            }
        }

        function showHistoryPassword(id) {
            var placeholder = document.getElementById('placeholder-' + id)
            var rawPassword = document.getElementById('raw-' + id)
            var hiddenClass = "d-none"

            if (placeholder.classList.contains(hiddenClass)) {
                // show raw
                placeholder.classList.remove(hiddenClass)
                rawPassword.classList.add(hiddenClass)
            } else {
                // show place
                rawPassword.classList.remove(hiddenClass)
                placeholder.classList.add(hiddenClass)
            }
        }
    </script>
@endsection
