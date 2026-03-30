<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{ Vite::useBuildDirectory('build/admin') }}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>@yield('title', config('admin.title', 'Simple Admin'))</title>
    @yield('css')
    @vite('resources/assets/admin/scss/main.scss')
</head>
<body>
    <div id="app">
        @guest
            {{-- Authentication Page --}}
            <div class="content signin">
                <div class="row row-cols-1 align-items-center h-100">
                    <div class="col">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Main Admin Interface --}}
            <div class="sidebar-overlay d-md-none"></div>
            @include('admin.partials.sidebar')
            <div class="content">
                <div class="container-fluid">
                    @include('admin.partials.header') 
                    <main class="main">
                        @include('admin.partials.alert')
                        @yield('content')
                    </main>
                </div>
            </div>
        @endguest
    </div>
    @include('admin.partials.script')
</body>
</html>