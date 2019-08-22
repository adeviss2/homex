<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.public_include.head')
    <body>
        @include('layouts.public_include.header')

        <main role="main">
            @yield('content')
        </main>
        @include('layouts.public_include.footer')
    </body>

</html>
