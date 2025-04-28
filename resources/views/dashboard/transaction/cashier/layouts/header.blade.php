<header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full text-sm">
    <div class="flex justify-between w-full items-center px-7">
        <div class=" flex text-2xl font-bold">Mitra Jeevan</div>
        <nav
            class="mt-4 relative max-w-3xl w-full bg-white border border-gray-200 rounded-full mx-2 py-2.5 md:flex md:items-center md:justify-between md:py-0 md:px-4 md:mx-auto dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-4 md:px-0 flex justify-between items-center">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-hidden focus:opacity-80"
                        href="../templates/personal/index.html" aria-label="Preline">
                        JEEVAN
                    </a>
                    <!-- End Logo -->

                    <div class="ms-1 sm:ms-2">

                    </div>
                </div>

                <div class="md:hidden">
                    <!-- Toggle Button -->
                    <button type="button"
                        class="hs-collapse-toggle flex justify-center items-center size-7 border border-gray-200 text-gray-500 rounded-full hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        id="hs-navbar-header-floating-collapse" aria-expanded="false"
                        aria-controls="hs-navbar-header-floating" aria-label="Toggle navigation"
                        data-hs-collapse="#hs-navbar-header-floating">
                        <svg class="hs-collapse-open:hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                    <!-- End Toggle Button -->
                </div>
            </div>

            <div id="hs-navbar-header-floating"
                class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow md:block"
                aria-labelledby="hs-navbar-header-floating-collapse">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-end gap-2 md:gap-3 mt-3 md:mt-0 py-2 md:py-0 md:ps-7">
                    <a class="@if (request()->routeIs('dashboards.cashier.home')) sales-menu-active @else sales-menu-default @endif  focus:outline-hidden"
                        href="#">Home</a>
                    <a class="@if (request()->routeIs('dashboards.cashier.index')) sales-menu-active @else sales-menu-default @endif focus:outline-hidden"
                        href="{{ route('dashboards.cashier.index') }}"  aria-current="page">Kasir</a>
                    <a class="@if (request()->routeIs('dashboards.cashier.sales.get_sales')) sales-menu-active @else sales-menu-default @endif focus:outline-hidden"
                        href="{{  route('dashboards.cashier.sales.get_sales')  }}">Panjualan</a>
                    <a class="py-0.5 md:py-3 px-4 md:px-1 border-s-2 md:border-s-0 md:border-b-2 border-transparent text-gray-500 hover:text-gray-800 focus:outline-hidden dark:text-neutral-400 dark:hover:text-neutral-200"
                        href="#">Laporan</a>
                </div>
            </div>
        </nav>
        <nav
            class="mt-4 relative  bg-white border border-gray-200 rounded-full mx-2 py-2.5 md:flex md:items-center md:justify-between md:py-0 md:px-4 dark:bg-neutral-800 dark:border-neutral-700">
            <div id="hs-navbar-header-floating"
                class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow md:block"
                aria-labelledby="hs-navbar-header-floating-collapse">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-end gap-2 md:gap-3 mt-3 md:mt-0 py-2 md:py-0">
                    <a class="py-0.5 md:py-3 px-4 md:px-1 border-s-2 md:border-s-0 md:border-b-2 border-transparent text-gray-500 hover:text-gray-800 focus:outline-hidden dark:text-neutral-400 dark:hover:text-neutral-200"
                        href="#">
                        <div
                            class="flex flex-nowrap space-x-3 items-center">
                            <span>vigoalmaurif</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
