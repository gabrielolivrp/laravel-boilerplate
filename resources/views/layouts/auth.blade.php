<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title') </title>

    <!-- css files -->
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    @stack('styles')

    @include('includes.partials.ga')
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center mb-3">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="{{ asset('img/coreui.svg#full') }}"></use>
                    </svg>
                </div>

                @yield('content')
            </div>
        </div>
    </div>
    <!-- js files -->
    @stack('scripts')
</body>
</html>
