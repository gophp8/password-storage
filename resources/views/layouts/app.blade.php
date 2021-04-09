
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>@lang('Password Management') - @lang('GoPHP8')</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet';" />
</head>
<body>

<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="{{route('password.index')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">@lang('GoPHP8') - @lang('Password Management')</span>
            </a>
        </header>

        @yield('content')

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021 @lang('by') @lang('GoPHP8')
        </footer>
    </div>
</main>

<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


</body>
</html>
