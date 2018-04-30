<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('error_title')</title>

        <!-- Styles -->
        @include('errors.parts._style')

    </head>
    <body>
        <div class="flex-center position-ref full-height">
          @if (Auth::user())
            <div class="top-right links">
              <a href="{{ route('home')}}">Back to Home</a>
            </div>
          @else
            <div class="top-right links">
              <a href="{{ route('login')}}">Back to Home Page</a>
            </div>
          @endif

        @yield('content')
    </body>
</html>
