@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }} <br />
        @endforeach
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
