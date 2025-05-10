<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\RequestOrder;
use App\Models\RequestOrderItem;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ShowRequestOrder extends Component
{
    public $noorder;
    public $type;
    public $requestOrderItems = [];
    public $requestOrder;
    public $activeTab = 'tab1';
    public $tabLoaded = [
        'tab1' => true,  // Tab pertama auto-load
        'tab2' => false,
        'tab3' => false,
        'tab4' => false,
        'tab5' => false,
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


        $this->requestOrderItems = RequestOrderItem::selectRaw("
            request_order_items.*,
            request_orders.from_warehouse_id,
            request_orders.to_warehouse_id,
            product_units.name as satuan_request,
            request_order_unit_conversion.conversion_factor,
            request_orders.status as order_status,
            (
                SELECT DISTINCT 
                    (stock_alocations.quantity * puc_source.conversion_factor ) as stockSourceWarehouse
                FROM 
                    stock_alocations
                JOIN 
                    product_unit_conversions as puc_source
                    ON  stock_alocations.product_id = puc_source.product_id 
                    AND  stock_alocations.product_unit_id = puc_source.product_unit_id
                WHERE 
                    stock_alocations.product_id = request_order_items.product_id
                AND
                    stock_alocations.location_id = request_orders.to_warehouse_id
                lIMIT 1
            ) AS stock_source_warehouse,

            (
                SELECT DISTINCT 
                    (stock_alocations.quantity * puc_destination.conversion_factor / request_order_unit_conversion.conversion_factor) as stockDestinationWarehouse
                FROM 
                    stock_alocations
                JOIN 
                    product_unit_conversions as puc_destination
                    ON  stock_alocations.product_id = puc_destination.product_id 
                    AND  request_order_items.satuan_request_id = puc_destination.product_unit_id
                WHERE 
                    stock_alocations.product_id = request_order_items.product_id
                AND
                    stock_alocations.location_id = request_orders.from_warehouse_id
                lIMIT 1
            ) AS stock_destination_warehouse
        ")
            ->with(['product', 'unitSourceWarehouse', 'unitDestinationWarehouse', 'unitApproved'])
            ->join('request_orders', 'request_orders.id', '=', 'request_order_items.request_order_id')
            ->join('product_units', 'request_order_items.satuan_request_id', '=', 'product_units.id')
            ->join('product_unit_conversions as request_order_unit_conversion', function ($join) {
                $join->on('request_order_items.satuan_request_id', '=', 'request_order_unit_conversion.product_unit_id')
                    ->on('request_order_items.product_id', '=', 'request_order_unit_conversion.product_id')
                    ->limit(1);
            })
            ->where('request_order_id', $this->requestOrder->id)
            ->distinct()
            ->orderBy('request_order_items.id', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    ...$item->toArray(), // semua kolom
                    'qtyApproved' =>  $item->status == 'rejected' ? 0 : ($item->status == '' ? number_format(0, 2) : number_format($item->qty_approved, 2)),
                    'sisa_source_warehouse' => $item->stock_source_warehouse - $item->qty_request,
                    'reject_reason' => ''
                ];
            })
            ->toArray();

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
