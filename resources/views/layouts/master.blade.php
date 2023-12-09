<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="detached" data-sidebar="light" data-topbar="dark"
    data-sidebar-size="lg">

<head>
    <title>{{ config('app.name') . ' - ' }}@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="{{ config('app.name') }}" />
    <meta name="keyword" content="{{ $keyword ?? config('app.name') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="android-chrome-192x192" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
    <link rel="android-chrome-512x512" sizes="512x512" href="{{ asset('android-chrome-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @include('layouts.head')
</head>

<body>
    <div id="layout-wrapper">
        @include('layouts.header')
        @include('layouts.aside')
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.modal')
    <button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    @include('layouts.js')
    @yield('custom_js')
</body>

</html>
