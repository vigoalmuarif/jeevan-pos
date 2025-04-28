<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ 'Export PDF Permintaan ARANG' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="">
    {{-- header --}}
    <div class="">
        <div class="header">
            <h1 class="mb-0 p-0 text-gray-950"> {{ $company->business_name }}</h1>
            <p class="mb-0 p-0">{{ $company->address }}</p>
            <hr class="border-2 mt-4 mb-6 border-gray-900 " />
        </div>
    </div>

{{-- 
    <script src="{{ asset('assets/library/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/library/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/library/pikaday/pikaday.js') }}"></script>
    <script src="{{ asset('assets/library/momentjs/moment.min.js') }}"></script> --}}
</body>

</html>
