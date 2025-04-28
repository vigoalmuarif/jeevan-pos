<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sales')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @livewireStyles --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/library/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/toastify/toastify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/pikaday/pikaday.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/my-style/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/my-style/custom.css') }}">
    @stack('head-scripts')
</head>

<body class="bg-gray-50 dark:bg-neutral-900 h-screen">
    <!-- ========== HEADER ========== -->
    <div class="relative">
        @include('dashboard.transaction.cashier.layouts.header')
    </div>

    <!-- ========== END HEADER ========== -->
    <div class="mx-2.5 sm:mx-4 md:mx-6">
        @yield('contents')
    </div>
    @if(!request()->routeIs('dashboards.cashier.index'))

        <footer class="bg-white  dark:bg-gray-800 absolute w-full bottom-0">
            <div class="w-full mx-auto p-4 px-8 md:flex md:items-center md:justify-between">
              <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a cl href="https://flowbite.com/" class="hover:underline text-primary-500 font-semibold">Jeevan</a>. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
            </div>
        </footer>
    @endif
    {{-- @livewireScripts --}}
    <x-toaster-hub />
    <script src="{{ asset('assets/library/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/library/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/library/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/library/pikaday/pikaday.js') }}"></script>
    <script src="{{ asset('assets/library/momentjs/moment.min.js') }}"></script>
    <script src="{{ asset('assets/library/autonumeric/autonumeric.min.js') }}"></script>
    <script src="{{ asset('assets/library/toastify/toastify.js') }}"></script>
    <script src="{{ asset('assets/library/confetti/confetti.min.js') }}"></script>
    <script src="{{ asset('assets/library/html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script src="{{ asset('assets/my-style/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

    @stack('body-scripts')
</body>
<script>
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        moment.locale('id');
        window.HSStaticMethods.autoInit();
        setInterval(() => {
            var today = moment();
            var day = today.format('dddd, LL');
            var time = today.format('HH:mm:ss');
            $(".today-day").text(day)
            $('.today-time').text(time)
        }, 1000);
    })
</script>

</html>
