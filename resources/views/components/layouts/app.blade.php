<!DOCTYPE html>
<html class="scrollbar-thin" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    

    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : 'Undangan Website' . ' - ' . config('app.name') }}
    </title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/library/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/pikaday/pikaday.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/my-style/loading.css') }}">
    {{-- @fluxAppearance --}}
    <!-- Scripts -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/dashboard-template/preline.min.css') }}"> --}}
</head>

<body class="bg-gray-50 dark:bg-neutral-900">
    <!-- ========== HEADER ========== -->
    @include('components.layouts.admin.header')
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Breadcrumb -->
    @include('components.layouts.admin.breadcrumb')
    <!-- End Breadcrumb -->

    <!-- Sidebar -->
    @include('components.layouts.admin.sidebar')
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="px-4 pb-6">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
    <x-toaster-hub />
    <script src="{{ asset('assets/library/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/library/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/library/pikaday/pikaday.js') }}"></script>
    <script src="{{ asset('assets/library/momentjs/moment.min.js') }}"></script>
    <script src="{{ asset('assets/library/autonumeric/autonumeric.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script src="{{ asset('assets/library/sweetalert2/sweetalert2.all.min.js') }}"></script>
    

    {{-- <script src="{{ asset('vendor/livewire-alert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> --}}

    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    {{-- @fluxScripts --}}
    @livewire('wire-elements-modal')
    @stack('body-scripts')
</body>

</html>
