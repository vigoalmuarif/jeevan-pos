<div>
    <x-admin.heading class="pb-5" back="dashboards.inventories.products.index">
        Detail Produk
    </x-admin.heading>
    <div class="flex">
        <div
            class="flex bg-gray-200/70 rounded-lg transition p-2 dark:bg-isDark dark:hover:bg-slate-800 w-full">
            <nav class="flex gap-x-2" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button"
                    class="hs-tab-active:bg-primary-700/70 hs-tab-active:text-white hs-tab-active:dark:bg-slate-900 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-primary-700/70 py-2 px-4 inline-flex items-center gap-x-2 bg-white text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-primary-300 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active"
                    id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1"
                    role="tab" active>
                    General
                </button>
                <button type="button"
                    class="hs-tab-active:bg-primary-700/70 hs-tab-active:text-white hs-tab-active:dark:bg-slate-900 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-primary-700/70 py-2 px-4 inline-flex items-center gap-x-2 bg-white text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-primary-300 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white"
                    id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2"
                    role="tab">
                    Konversi Satuan
                </button>
                <button type="button"
                    class="hs-tab-active:bg-primary-700/70 hs-tab-active:text-white hs-tab-active:dark:bg-slate-900 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-primary-700/70 py-2 px-4 inline-flex items-center gap-x-2 bg-white text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-primary-300 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white"
                    id="segment-item-3" aria-selected="false" data-hs-tab="#segment-3" aria-controls="segment-3"
                    role="tab">
                    Alokasi
                </button>
                <button type="button"
                    class="hs-tab-active:bg-primary-700/70 hs-tab-active:text-white hs-tab-active:dark:bg-slate-900 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-primary-700/70 py-2 px-4 inline-flex items-center gap-x-2 bg-white text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-primary-300 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white"
                    id="segment-item-4" aria-selected="false" data-hs-tab="#segment-4" aria-controls="segment-4"
                    role="tab">
                    Harga
                </button>
                <button type="button"
                    class="hs-tab-active:bg-primary-700/70 hs-tab-active:text-white hs-tab-active:dark:bg-slate-900 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-primary-700/70 py-2 px-4 inline-flex items-center gap-x-2 bg-white text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-primary-300 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white"
                    id="segment-item-5" aria-selected="false" data-hs-tab="#segment-5" aria-controls="segment-5"
                    role="tab">
                    Meta Data
                </button>
            </nav>
        </div>
    </div>
    
    <div class="mt-3">
        <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
           <livewire:dashboard.inventory.product.show.general.general :product="$product" />
        </div>
        <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
            <livewire:dashboard.inventory.product.konversi-unit.konversi-unit :units="$units" :product="$product" :unitConversions="$unitConversions" />
        </div>
        <div id="segment-3" class="hidden" role="tabpanel" aria-labelledby="segment-item-3">
            <livewire:dashboard.inventory.product.alokasi.alokasi  :units="$units" :product="$product" :unitConversions="$unitConversions" />
        </div>
        <div id="segment-4" class="hidden" role="tabpanel" aria-labelledby="segment-item-4">
            <livewire:dashboard.inventory.product.price.price  :units="$units" :product="$product" :unitConversions="$unitConversions" />
        </div>
        <div id="segment-5" class="hidden" role="tabpanel" aria-labelledby="segment-item-5">
            TEST
        </div>
    </div>
</div>
