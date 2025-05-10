<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\RequestOrderDelivery;
use App\Models\RequestOrderDeliveryItem;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeliveryDetail extends ModalComponent
{
    public  $delivery;

    public function mount()
    {
        $this->delivery = RequestOrderDelivery::with(['user', 'requestOrder'])->find($this->delivery);
    }

    public static function modalMaxWidth(): string
{
    return '7xl';
}

    public function render()
    {
        $items = RequestOrderDeliveryItem::with(['unit', 'product'])->where("request_order_delivery_id", $this->delivery->id)->get();

        return view('livewire.dashboard.inventory.procurement.request-order.show-request-order.delivery-detail', [
            'items'=> $items
        ]);
    }
}
