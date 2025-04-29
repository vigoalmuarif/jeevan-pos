<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder;

use App\Models\Product;
use App\Models\RequestOrder;
use App\Models\RequestOrderItem;
use App\Models\StockAlocation;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CreateRequestOrder extends Component
{

    use LivewireAlert;
    public $fromWarehouse;
    public $toWarehouse;
    public $header_desc;
    public $searchProduct;
    public $stockSourceWarehouse;
    public $qtyRequest = 0;
    public $note;
    public $listProducts = [];
    public $productSelected = [];


    public function mount()
    {
        $user_warehouse = auth()->user()->current_branch_id;
        $this->fromWarehouse = $user_warehouse;
    }

    public function updatedToWarehouse($value)
    {
        if ($this->fromWarehouse == null) {
            Toaster::warning('Harap pilih gudang/cabang yang meminta!');
            $this->toWarehouse = null;
        }

        if ($this->fromWarehouse == $value) {
            Toaster::warning('Tidak boleh melakukan permintaan barang ke gudang yang sama!');
            $this->toWarehouse = null;
        }

        $this->resetFormAdd();
    }

    public function updatedFromWarehouse($value)
    {
        if ($this->toWarehouse == $value) {
            Toaster::warning('Tidak boleh melakukan permintaan barang ke gudang yang sama!');
            $this->fromWarehouse = null;
        }
        $this->resetFormAdd();
    }


    public function refresh()
    {
        if (count($this->listProducts) > 0) {
            $this->confirm('Reset Permintaan Barang?', [
                'text' => 'Semua daftar item barang akan dihapus.',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'confirmButtonText' => 'Reset',
                'cancelButtonText' => 'Tidak',
                'onConfirmed' => 'resetRequestOrder',
            ]);
            $this->resetFormAdd();
        }
    }

    #[On('resetRequestOrder')]
    public function resetRequestOrder()
    {
        $this->listProducts = [];
        if($this->fromWarehouse){
            $this->resetExcept(['fromWarehouse']);
        }else{
            $this->reset();
        }
    }

    public function resetFormAdd()
    {
        $this->productSelected['sourceWarehouse']['units'] = [];
        $this->productSelected['sourceWarehouse']['stockConversion'] = 0;
        $this->productSelected['destinationWarehouse']['units'] = [];
        $this->productSelected['destinationWarehouse']['stockConversion'] = 0;
        $this->qtyRequest = 0;
        $this->note = '';
        $this->searchProduct = '';
    }

    public function updatedSearchProduct($data)
    {
        $this->fetcProducts($data);
    }
    public function fetcProducts($data)
    {
        //gudang yang meminta
        $destinationWarehouse = StockAlocation::selectRaw("
            stock_alocations.*,
            product_unit_conversions.conversion_factor,
            product_unit_conversions.id as conversionID,
            product_unit_conversions.product_unit_id as unitID
        ")
        ->with(['product', 'unit', 'product.product_unit_conversions' => function ($q) {
            $q->distinct()
                ->orderBy('conversion_factor', 'asc');
        }])
            ->where('stock_alocations.product_id', $data)
            ->where('stock_alocations.location_id', $this->fromWarehouse)
            ->join('product_unit_conversions', function ($q) {
                $q->on('product_unit_conversions.product_id', 'stock_alocations.product_id')
                    ->on('product_unit_conversions.product_unit_id', 'stock_alocations.product_unit_id')
                    ->limit(1);
            })
            ->distinct()
            ->first();

        //gudang yang diminta
        $sourceWarehouse = StockAlocation::select('stock_alocations.*', 'product_unit_conversions.conversion_factor', 'product_unit_conversions.id as conversionID', 'product_unit_conversions.product_unit_id as unitID', 'product_units.name as unit')
            ->with(['product', 'product.product_unit_conversions' => function ($q) {
                $q->distinct()
                    ->orderBy('conversion_factor', 'asc');
            }])
            ->where('stock_alocations.product_id', $data)
            ->where('stock_alocations.location_id', $this->toWarehouse)
            ->join('product_unit_conversions', 'product_unit_conversions.id', 'stock_alocations.product_unit_conversion_id')
            ->join('product_units', 'product_units.id', 'stock_alocations.product_unit_id')
            ->distinct()
            ->first();

        if (!$sourceWarehouse) {
            Toaster::warning('Product tidak tersedia pada gudang');
            return $this->resetFormAdd();
        }


        $this->productSelected['sourceWarehouse'] = [
            'productID' => $sourceWarehouse->product_id,
            'productSku' => $sourceWarehouse->product->sku,
            'productName' => $sourceWarehouse->product->name,
            'unitID' => $sourceWarehouse->unitID,
            'unitName' => $sourceWarehouse->unit,
            'stockConversion' => (float) $sourceWarehouse->quantity * $sourceWarehouse->conversion_factor / $destinationWarehouse->conversion_factor,
            'qtyConversion' =>  $sourceWarehouse->conversion_factor,
            'realStock' => $sourceWarehouse->quantity,
            'stockConversionToSmall' => $sourceWarehouse->quantity * $sourceWarehouse->conversion_factor,
            'units' => $sourceWarehouse->product->product_unit_conversions
        ];
        $this->productSelected['destinationWarehouse'] = [
            'productID' => $destinationWarehouse->product_id,
            'productSku' => $destinationWarehouse->product->sku,
            'productName' => $destinationWarehouse->product->name,
            'unitID' => $destinationWarehouse->unit->id,
            'unitName' => $destinationWarehouse->unit->name,
            'stockConversion' => (float) $destinationWarehouse->quantity * $destinationWarehouse->conversion_factor / $destinationWarehouse->conversion_factor,
            'qtyConversion' => $destinationWarehouse->conversion_factor,
            'units' => $destinationWarehouse->product->product_unit_conversions
        ];
    }

    public function addProduct()
    {
        $this->listProducts[] = [
            'productID' => $this->productSelected['destinationWarehouse']['productID'],
            'productSku' => $this->productSelected['destinationWarehouse']['productSku'],
            'productName' => $this->productSelected['destinationWarehouse']['productName'],
            'stockUnit' => $this->productSelected['destinationWarehouse']['stockConversion'],
            'satuanDestinationID' => $this->productSelected['destinationWarehouse']['unitID'],
            'qtyRequest' => $this->qtyRequest,
            'note' => $this->note,
            'satuanUnit' => $this->productSelected['destinationWarehouse']['unitName'],
            'stockWarehouse' => $this->productSelected['sourceWarehouse']['stockConversion'],
            'satuanWarehouseID' => $this->productSelected['sourceWarehouse']['unitID'],
            'satuanWarehouse' => $this->productSelected['sourceWarehouse']['unitName'],
        ];
        $this->resetFormAdd();
        $this->dispatch('added-item');
    }

    public function delete($index)
    {
        unset($this->listProducts[$index]);
        array_values($this->listProducts);
    }

    public function save($is_draft = null)
    {
        $user = auth()->user();
        //pastikan unit peminta dan unit yang diminta tidak sama
        if ($this->toWarehouse == $this->fromWarehouse) {
            Toaster::warning('Tidak boleh melakukan permintaan barang ke gudang yang sama!');
            return;
        }

        //check unit peminta & unit yang diminta
        if (!$this->fromWarehouse || !$this->toWarehouse) {
            Toaster::warning('Unit peminta atau unit yang diminta belum dipilih!');
            return;
        }

        //check unit peminta
        $destinationWarehouse = Warehouses::where('id', $this->fromWarehouse)
            ->where('business_id', $user->current_active_business_id)
            ->first();

        if (!$destinationWarehouse) {
            Toaster::warning('Unit Peminta tidak ditemukan!');
            return;
        }

        // check unit yang diminta
        $destinationWarehouse = Warehouses::where('id', $this->toWarehouse)
            ->where('business_id', $user->current_active_business_id)
            ->first();

        if (!$destinationWarehouse) {
            Toaster::warning('Unit yang diminta tidak ditemukan!');
            return;
        }

        //proses simpan

        //generate no order
        $generateNoOrder =  $this->generateNoOrder();

        DB::beginTransaction();

        try {
            //simpan header
            $requestOrder = RequestOrder::create([
                'no_order' => $generateNoOrder,
                'from_warehouse_id' => $this->fromWarehouse,
                'to_warehouse_id' => $this->toWarehouse,
                'status' => $is_draft ?? 'requested',
                'business_id' => $user->current_active_business_id,
                'note' => $this->header_desc,
                'request_at' => date('Y-m-d H:i:s'),
                'request_by' => $user->id,
            ]);

            //simpan detail
            $items = [];
            foreach ($this->listProducts as $product) {
                $items[] = [
                    'request_order_id' => $requestOrder->id,
                    'product_id' => $product['productID'],
                    'satuan_request_id' => $product['satuanDestinationID'],
                    'qty_request' => $product['qtyRequest'],
                    'qty_approved' => 0,
                    'note' => $product['note'],
                    'status' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            RequestOrderItem::insert($items);

            DB::commit();
            $this->refresh();
            return redirect()->route('dashboards.inventories.procurements.request_orders.outbound_requests.index')->success('Permintaan barang berhasil dibuat!');

        } catch (\Throwable $e) {
            DB::rollBack();
           Toaster::error($e->getMessage());
        }
    }

    public function generateNoOrder()
    {
        $now = Carbon::now();

        $prefix = 'RO';
        $month = $now->format('m');     // 01-12
        $year = $now->format('y');      // ambil angka belakang misal 2025 -> 25

        $base = $prefix . $month . $year; // RO0425

        // Hitung jumlah order bulan ini
        $lastOrder = RequestOrder::where('no_order', 'ilike', $base . '%')
            ->orderBy('no_order', 'desc')
            ->first();
           

        if ($lastOrder) {
            // Ambil nomor urut terakhir dan tambah 1
            $lastNumber = (int) substr($lastOrder->no_order, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $base . $newNumber;
    }

    public function render()
    {
        $warehouses = Warehouses::where('business_id', auth()->user()->current_active_business_id)->get();
        $products = Product::with(['alocations.unit', 'alocations' => function ($q) {
            $q->where('location_id', $this->fromWarehouse);
        }])->where('business_id', auth()->user()->current_active_business_id)
            ->whereHas('alocations', function ($q) {
                $q->where('location_id', $this->fromWarehouse);
            })
            ->when($this->listProducts, function ($q) {
                $q->whereNotIn('id', collect($this->listProducts)->pluck('productID')->toArray());
            })
            ->get();

        return view('livewire.dashboard.inventory.procurement.request-order.create-request-order', [
            'warehouses' => $warehouses,
            'products' => $products,
        ]);
    }
}
