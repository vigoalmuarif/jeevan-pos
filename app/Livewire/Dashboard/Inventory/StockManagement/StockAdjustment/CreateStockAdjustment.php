<?php

namespace App\Livewire\Dashboard\Inventory\StockManagement\StockAdjustment;

use App\Models\Product;
use App\Models\StockAdjusment;
use App\Models\StockAlocation;
use App\Models\StockCard;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

#[Title('Tambah penyesuaian stok')]
class CreateStockAdjustment extends Component
{
    use LivewireAlert;
    public $warehouseSelected;
    public $productSelectedValue;
    public $productSelected;
    public $fetchProducts = [];
    public $itemSelected = [];
    public $formUnit;
    public $formUnitName;
    public $formQtyAwal = 0;
    public $formQtyAktual = 0;
    public $formQtySelisih = 0;
    public $formReason;
    public $listProducts = [];

    public function updatedWarehouseSelected()
    {
        $this->fetchProducts = [];
        $this->resetExcept('warehouseSelected');
        if ($this->warehouseSelected == null) {
            $this->confirm('Gudang / Branch belum dipilih!', [
                'icon' => 'warning',
                'showCancelButton' => true,
                'showConfirmButton' => false,
                'cancelButtonText' => 'Oke',
            ]);
            return;
        }

        $this->fetchProducts = Product::whereHas('alocations', function ($q) {
            return $q->where('location_id', $this->warehouseSelected);
        })
            ->limit('20')
            ->get();
    }


    public function updatedProductSelected($product)
    {
        // $this->fetchProducts = [];

        $this->productSelectedValue = Product::with(['product_unit_conversions' => function ($q) {
            $q->orderby('pivot_conversion_factor', 'asc');
        }])
            ->whereHas('alocations', function ($q) {
                return $q->where('location_id', $this->warehouseSelected);
            })
            ->where('id', $product)
            ->first();

        $this->formUnit = $this->productSelectedValue->product_unit_conversions[0]->id;
        $this->formUnitName = $this->productSelectedValue->product_unit_conversions[0]->name;

        $stock = StockAlocation::where('stock_alocations.product_id', $this->productSelectedValue->id)
            ->join('product_unit_conversions', function ($join) {
                $join->on('stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id')
                    ->on('stock_alocations.product_id', 'product_unit_conversions.product_id');
            })
            ->where('location_id', $this->warehouseSelected)
            ->first();


        $this->formQtyAwal = $stock->quantity * $stock->conversion_factor;
        $this->formQtyAktual = $this->formQtyAwal;
        $this->formQtySelisih = (float) $this->formQtyAktual - $this->formQtyAwal;
    }

    public function updatedformQtyAktual($value)
    {
        $this->formQtySelisih = (float) $value - $this->formQtyAwal;
    }

    public function addProduct()
    {
        $this->validate(
            [
                'formQtyAwal' => 'required|numeric',
                'formQtyAktual' => 'required|numeric',
                'formReason' => 'required',
            ],
            [
                'formQtyAwal.required' => 'Harap masukan qty awal.',
                'formQtyAwal.numeric' => 'Harap masukan angka.',
                'formQtyAktual.required' => 'Harap masukan qty aktual.',
                'formQtyAktual.numeric' => 'Harap masukan angka.',
                'formReason.required' => 'Harap masukan alasan.',
            ]
        );

        $this->listProducts[] = [
            'productID' => $this->productSelectedValue->id,
            'productName' => $this->productSelectedValue->name,
            'unitID' => $this->formUnit,
            'unitName' => $this->formUnitName,
            'qtyAwal' => $this->formQtyAwal,
            'qtyAktual' => $this->formQtyAktual,
            'qtySelisih' => $this->formQtySelisih,
            'reason' => $this->formReason,
            'warehouseID' => $this->warehouseSelected,
        ];

        DB::transaction(function () {
            $produk = StockAlocation::where('product_id', $this->productSelectedValue->id)
                ->where('location_id', $this->warehouseSelected)
                ->lockForUpdate()->first();

            if (!$produk) {
                throw new \Exception("Produk tidak ditemukan");
            }

            $produk->status_proses = true;
            $produk->save();
        });
        // $this->resetExcept(['warehouseSelected', 'productSelected']); 
        $this->productSelectedValue = null;
        $this->productSelected = null;
        $this->formUnit = null;
        $this->formQtyAwal = null;
        $this->formQtyAktual = null;
        $this->formQtySelisih = null;
        $this->formReason = null;
    }

    public function save()
    {
        try {
            DB::transaction(function () {
                if (count($this->listProducts) === 0) {
                    Toaster::error('Data produk penyesuaian stok masih kosong!');
                    DB::rollBack();
                    return;
                }

                $data = collect($this->listProducts);
                $produk = StockAlocation::whereIn('product_id', $data->pluck('productID')->toArray())
                    ->where('location_id', $this->warehouseSelected)
                    ->lockForUpdate()->get();


                foreach ($this->listProducts as $item) {
                    $stock = StockAlocation::where('stock_alocations.product_id', $item['productID'])
                        ->join('product_unit_conversions', function ($join) {
                            $join->on('stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id')
                                ->on('stock_alocations.product_id', 'product_unit_conversions.product_id');
                        })
                        ->where('location_id', $this->warehouseSelected)
                        ->first();

                    $stockAlocation = StockAlocation::where('product_id', $item['productID'])
                        ->where('location_id', $item['warehouseID'])
                        ->update([
                            'quantity' => $item['qtyAktual'] / $stock->conversion_factor,
                            'status_proses' => false,
                        ]);

                    $stockAdjustment = StockAdjusment::create([
                        'product_id' => $item['productID'],
                        'stock_batch_id' => null,
                        'warehouse_id' => $item['warehouseID'],
                        'product_unit_id' => $item['unitID'],
                        'adjusment_type' => ($item['qtyAktual'] - $item['qtyAwal']) >= 0 ? 'Increas' : 'Descreas',
                        'qty' => abs($item['qtyAktual'] - $item['qtyAwal']),
                        'stock_awal' => $item['qtyAwal'],
                        'stock_akhir' => $item['qtyAktual'],
                        'selisih' => $item['qtySelisih'],
                        'reason' => $item['reason'],
                        'adjustment_by' => Auth::id()
                    ]);

                    $stockCard = StockCard::create([
                        'product_id' => $item['productID'],
                        'stock_batch_id' => null,
                        'warehouse_id' => $item['warehouseID'],
                        'product_unit_id' => $item['unitID'],
                        'movement_type' => ($item['qtyAktual'] - $item['qtyAwal']) >= 0 ? 'In' : 'Out',
                        'qty' => abs($item['qtyAwal'] - $item['qtyAktual']),
                        'qty_awal' => $item['qtyAwal'],
                        'qty_akhir' => $item['qtyAktual'],
                        'user_proccess_id' => Auth::id(),
                        'desc' => 'Proccess Adjustment',
                        'reference_type' => 'App\Models\StockAdjusment',
                        'reference_id' => $stockAdjustment->id,
                        'transaction_date' => date('Y-m-d H:i:s')
                    ]);
                }
            });
            $this->dispatch('adjustment-success', true);
        } catch (\Throwable $e) {
            Log::error('error' . $e->getMessage());
            Toaster::error($e->getMessage());
            $this->dispatch('adjustment-success', false);
        }
    }

    #[On('form-reset')]
    public function closeModal()
    {
        $this->productSelectedValue = null;
        $this->productSelected = null;
        $this->formUnit = null;
        $this->formQtyAwal = null;
        $this->formQtyAktual = null;
        $this->formQtySelisih = null;
        $this->formReason = null;
        $this->listProducts = [];
        $this->warehouseSelected = null;
        $this->fetchProducts = [];
        $this->resetValidation();
    }


    #[On('confirmCloseModal')]
    public function closeConfirmed()
    {
        try {
            DB::transaction(function () {
                $data = collect($this->listProducts);
                $produk = StockAlocation::whereIn('product_id', $data->pluck('productID')->toArray())
                    ->where('location_id', $this->warehouseSelected)
                    ->lockForUpdate()->get();
                if (count($produk) == 0) {
                    throw new \Exception("Produk tidak ditemukan");
                }

                StockAlocation::whereIn('product_id', $data->pluck('productID')->toArray())
                    ->where('location_id', $this->warehouseSelected)
                    ->update(['status_proses' => null]);
            });
            $this->productSelectedValue = null;
            $this->productSelected = null;
            $this->formUnit = null;
            $this->formQtyAwal = null;
            $this->formQtyAktual = null;
            $this->formQtySelisih = null;
            $this->formReason = null;
            $this->listProducts = [];
            $this->warehouseSelected = null;
            $this->resetValidation();
            $this->dispatch('close-modal', true);
        } catch (\Throwable $e) {
            Log::error('Gagal adjustment: ' . $e->getMessage());
            $this->dispatch('close-modal', false);
            return;
        }
        $this->dispatch('close-modal', true);
    }

    public function render()
    {
        $Warehouses = Warehouses::where('business_id', auth()->user()->current_active_business_id)
            ->where('status', 1)
            ->get();
        return view('livewire.dashboard.inventory.stock-management.stock-adjustment.create-stock-adjustment', [
            'warehouses' => $Warehouses
        ]);
    }
}
