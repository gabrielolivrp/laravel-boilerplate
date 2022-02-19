<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title') </title>

    <!-- css files -->
    @livewireStyles
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    @stack('styles')

    @include('includes.partials.ga')
</head>
<body class="c-app">
    <div class="c-wrapper c-fixed-components">
        @include('app.includes.header')
        @include('includes.partials.logged-in-as')

        <div class="c-body">
            <main class="c-main">
                <div class="container">
                    <div class="fade-in">
                        @include('includes.partials.messages')
                        @yield('content')
                    </div><!--fade-in-->
                </div><!--container-fluid-->
            </main>
        </div><!--c-body-->

        @include('app.includes.footer')
    </div><!--c-wrapper-->

    <!-- js files -->
    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
