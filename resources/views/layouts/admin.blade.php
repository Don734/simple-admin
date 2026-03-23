<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{ Vite::useBuildDirectory('build/admin') }}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" /> --}}
    @yield('css')
    @vite('resources/assets/admin/scss/main.scss')
    <title>@yield('title', config('admin.title', 'Simple Admin'))</title>
</head>
<body>
    <div id="app">
        @guest
            {{-- Authentication Page --}}
            <div class="content signin">
                <div class="row row-cols-1 row-cols-md-2 align-items-center h-100">
                    <div class="col">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                    <div class="col h-100 d-none d-md-block">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <div class="navbar-brand">
                                        <span class="text">{!! config("admin.name") !!}</span>
                                    </div>
                                    <div class="btn-group social-btns gap-2 mt-2">
                                        <a href="#" class="btn"><i class="bi bi-telegram"></i></a>
                                        <a href="#" class="btn"><i class="bi bi-instagram"></i></a>
                                        <a href="#" class="btn"><i class="bi bi-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Main Admin Interface --}}
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