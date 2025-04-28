<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder;

use App\Models\RequestOrder as ModelsRequestOrder;
use Livewire\Component;
use Livewire\WithPagination;

class RequestOrder extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;

    public function create()
    {
        $this->dispatch('openModal', component: 'dashboard.inventory.procurement.request-order.create-request-order');
    }
    public function render()
    {
        $warehouse = auth()->user()->current_branch_id;

        if (request()->routeIs('dashboards.inventories.procurements.request_orders.inbound_requests.*')) {
            $where = ' from_warehouse_id = ' . $warehouse .' AND to_warehouse_id != ' .$warehouse;
            $type = 'inbound_requests';
        } else {
            $where = ' from_warehouse_id != ' . $warehouse .' AND to_warehouse_id = ' .$warehouse;
            $type = 'outbound_requests';
        }
        $orders = ModelsRequestOrder::withCount('items')
            ->where('business_id', auth()->user()->current_active_business_id)
            ->whereRaw($where)
            ->paginate(10);

        return view('livewire.dashboard.inventory.procurement.request-order.request-order', [
            'orders' => $orders,
            'type' => $type
        ]);
    }
}
