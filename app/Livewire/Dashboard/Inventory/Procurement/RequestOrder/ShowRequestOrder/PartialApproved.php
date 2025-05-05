<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\RequestOrderItem;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PartialApproved extends Component
{
    public $requestOrder;
    public $requestOrderItems = [];
    public $items = [];
    public $removedItems = [];
    public $showProsesSimpan = true;


    public function mount()
    {
        $this->requestOrderItems = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return  $item['status'] == 'partial_approved';
            });
    }

    public function added($id, $productID)
    {
        $product = collect($this->requestOrderItems)->firstWhere('product_id', $productID);

        $this->items[] = [
            'id' => $product['id'],
            'product' => $product['product'],
            'satuan' => $product['satuan_request'],
            'kekurangan' => $product['qty_request'] - $product['qtyApproved'],
            'qty_request' => $product['qty_request'],
            'qty_approved' => 0,
            'status' => '',
        ];

        //masukan dalam temporary
        $this->removedItems = collect($this->removedItems)
            ->push($product)
            ->values();


        // Remove the item from requestOrderItems
        $this->requestOrderItems = collect($this->requestOrderItems)
            ->filter(function ($item) use ($productID) {
                return  $item['product_id'] != $productID;
            });

    }

    public function selectAll()
    {
        $this->items[] = [
            'id' => $orderItem->id,
            'product' => $orderItem->product,
            'satuan' => $orderItem->unit,
            'kekurangan' => $orderItem->qty_request - $orderItem->qtyApproved,
            'qty_request' => $orderItem->qty_request,
            'qty_approved' => 0,
            'status' => '',
        ];

        //masukan dalam temporary
        $product = collect($this->requestOrderItems)->firstWhere('product_id', $productID);

        $this->removedItems = collect($this->removedItems)
            ->push($product)
            ->values();


        // Remove the item from requestOrderItems
        $this->requestOrderItems = collect($this->requestOrderItems)
            ->filter(function ($item) use ($productID) {
                return  $item['product_id'] != $productID;
            });

    }


    public function cancel($id)
    {
        // tambah kembali produk dari items yang dihapus
        $product = collect($this->removedItems)->firstWhere('id', $id);

        $this->requestOrderItems = collect($this->requestOrderItems)
            ->push($product)
            ->values();

         // hapus dari daftar items
         $this->items = collect($this->items)
         ->filter(function ($item) use ($id) {
             return  $item['id'] != $id;
         })->values();

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
        return view('livewire.dashboard.inventory.procurement.request-order.show-request-order.partial-approved');
    }
}
