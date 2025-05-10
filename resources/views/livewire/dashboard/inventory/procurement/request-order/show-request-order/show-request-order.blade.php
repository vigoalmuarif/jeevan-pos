<div>
    @php
        if ($type == 'inbound_requests') {
            $routeBack = 'dashboards.inventories.procurements.request_orders.inbound_requests.index';
        } else {
            $routeBack = 'dashboards.inventories.procurements.request_orders.outbound_requests.index';
        }
    @endphp
    <x-admin.heading class="pb-5" back="{{ $routeBack }}">
        Detail Permintaan {{ $type == 'inbound_request' ? 'Masuk' : 'Keluar' }}
    </x-admin.heading>
    
    <livewire:dashboard.inventory.procurement.request-order.show-request-order.header
    :$requestOrder wire:key="summary-request-order" :$requestOrderItems />

    <div class="flex w-full">
        <div class="flex bg-gray-100  rounded-lg transition p-1 dark:bg-neutral-800  w-full">
            <nav class="flex gap-x-1 p-1" aria-orientation="horizontal">
                <button type="button" wire:click="switchTab('tab1')" wire:loading.class="pointer-events-none"
                    class="{{ $activeTab == 'tab1' ? 'tab-active' : 'tab-default' }}">
                    Permintaan
                </button>
                <button type="button" wire:click="switchTab('tab2')" wire:loading.class="pointer-events-none"
                    class="{{ $activeTab == 'tab2' ? 'tab-active' : 'tab-default' }}">
                    Partial Approve
                </button>
                <button type="button" wire:click="switchTab('tab3')" wire:loading.class="pointer-events-none"
                    class="{{ $activeTab == 'tab3' ? 'tab-active' : 'tab-default' }}">
                    Pengiriman
                </button>
                <button type="button" wire:click="switchTab('tab4')" wire:loading.class="pointer-events-none"
                    class="{{ $activeTab == 'tab4' ? 'tab-active' : 'tab-default' }}">
                    Penerimaan
                </button>
                <button type="button" wire:click="switchTab('tab5')" wire:loading.class="pointer-events-none"
                    class="{{ $activeTab == 'tab5' ? 'tab-active' : 'tab-default' }}">
                    Retur
                </button>
            </nav>
        </div>
    </div>

    <div class="mt-3">
        <div x-data="{ tab : $wire.entangle('activeTab') }">
            @if($tabLoaded['tab1'] == true)
            <div x-show="tab == 'tab1'">
                <livewire:dashboard.inventory.procurement.request-order.show-request-order.request-order-items lazy
                    :$requestOrder :$requestOrderItems wire:key="tab1" />
            </div>
            @endif

            @if($tabLoaded['tab2'] == true)
            <div x-show="tab == 'tab2'">
                <livewire:dashboard.inventory.procurement.request-order.show-request-order.partial-approved lazy
                    :$requestOrder :$requestOrderItems wire:key="tab2" />
            </div>
            @endif

            @if($tabLoaded['tab3'] == true)
            <div x-show="tab == 'tab3'">
                <livewire:dashboard.inventory.procurement.request-order.show-request-order.delivery lazy
                    :$requestOrder :$requestOrderItems wire:key="tab3" />
            </div>
            @endif

            @if($tabLoaded['tab4'] == true)
            <div x-show="tab == 'tab4'">
                <livewire:dashboard.inventory.procurement.request-order.show-request-order.received lazy
                    :$requestOrder :$requestOrderItems wire:key="tab4" />
            </div>
            @endif

            @if($tabLoaded['tab5'] == true)
            <div x-show="tab == 'tab5'">
                <livewire:dashboard.inventory.procurement.request-order.show-request-order.retur lazy
                    :$requestOrder :$requestOrderItems wire:key="tab5" />
            </div>
            @endif
        </div>
    </div>

</div>
@script
    <script>
        Livewire.hook('message.failed', ({
            component
        }) => {
            console.error('Livewire failed for component:', component);
        });
    </script>
@endscript
