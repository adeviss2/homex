<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.include.head')

    <body>
        @include('layouts.include.header')

        <main role="main">
            @yield('content')
        </main>

        @include('layouts.include.footer')
    </body>

</html>
