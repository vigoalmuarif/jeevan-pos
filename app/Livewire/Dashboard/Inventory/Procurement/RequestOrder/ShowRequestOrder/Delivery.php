<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\RequestOrderDelivery;
use App\Models\RequestOrderDeliveryItem;
use App\Models\RequestOrderItem;
use Livewire\Component;

class Delivery extends Component
{
    public $requestOrder;


    public function detail($id)
    {
        $this->dispatch('openModal', component : 'dashboard.inventory.procurement.request-order.show-request-order.delivery-detail', arguments :  ['delivery' => $id]);
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center pt-20">
            <!-- Loading spinner... -->
            <p>Sedang memuat data....</p>
        </div>
        HTML;
    }


    public function render()
    {
        $deliveries = RequestOrderDelivery::with(['user', 'requestOrder'])
            ->where("request_order_id", $this->requestOrder->id)->get();

        return view('livewire.dashboard.inventory.procurement.request-order.show-request-order.delivery', [
            'deliveries' => $deliveries,
        ]);
    }
}
