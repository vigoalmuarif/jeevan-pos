<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\RequestOrder;
use Livewire\Component;

class ShowRequestOrder extends Component
{
    public $noorder;
    public $type;
    public $requestOrder;
    public $activeTab = 'tab1';
    public $tabLoaded = [
        'tab1' => true,  // Tab pertama auto-load
        'tab2' => false,
        'tab3' => false,
    ];

    public function mount()
    {
        $this->type = 'inbound_requests';
        $requestOrder = RequestOrder::with(['from_warehouse', 'to_warehouse', 'user', 'product.product_unit_conversions'])
            ->where('no_order', $this->noorder)->firstOrFail();


        //jika dari inbound request dan statusnya requested maka update status request order
        if (request()->routeIs('dashboards.inventories.procurements.request_orders.outbound_requests.*')) {
            $this->type = 'outbound_requests';
            if ($requestOrder && $requestOrder->status == 'requested') {
                $requestOrder->update([
                    'status' => 'reviewed',
                ]);
            }
        }

        $this->requestOrder = $requestOrder;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;

        if (!$this->tabLoaded[$tab]) {
            if ($tab === 'tab2') {
                $this->dispatch('tab-partial-approve', noorder: $this->noorder);
            } elseif ($tab === 'tab3') {
            }
    
            $this->tabLoaded[$tab] = true;
        }
    }

    public function render()
    {
        
        return view('livewire.dashboard.inventory.procurement.request-order.show-request-order.show-request-order');
    }
}
