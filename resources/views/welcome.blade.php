<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/flag-icon.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 60vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {!! session()->has('locale') ? '<div>Selected</div><span class="flag-icon flag-icon-' . Session::get('locale') . '"></span>' : 'Select language' !!}
                    <hr />
                </div>
                <table class="table" style="width:100%;">
                    <tr>
                        <td style="width:20%;">
                            <a href="{{ url('/lang/en') }}">
                                <div style="width:100%; height: 80px;" class="flag-icon flag-icon-en"></div>
                            </a>
                        </td>
                        <td style="width:20%;">
                            <a href="{{ url('/lang/es') }}">
                                <div style="width:100%; height: 80px;" class="flag-icon flag-icon-es"></div>
                            </a>
                        </td>
                        <td style="width:20%;">
                            <a href="{{ url('/lang/de') }}">
                                <div style="width:100%; height: 80px;" class="flag-icon flag-icon-de"></div>
                            </a>
                        </td>
                        <td style="width:20%;">
                            <a href="{{ url('/lang/fr') }}">
                                <div style="width:100%; height: 80px;" class="flag-icon flag-icon-fr"></div>
                            </a>
                        </td>
                        <td style="width:20%;">
                            <a href="{{ url('/lang/it') }}">
                                <div style="width:100%; height: 80px;" class="flag-icon flag-icon-it"></div>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td>Spanish</td>
                        <td>German</td>
                        <td>French</td>
                        <td>Italian</td>
                    </tr>
                </table>

            </div>
        </div>
    </body>
</html>
