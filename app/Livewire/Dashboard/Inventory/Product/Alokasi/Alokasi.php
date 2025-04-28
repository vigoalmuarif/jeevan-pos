<?php

namespace App\Livewire\Dashboard\Inventory\Product\Alokasi;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductUnit;
use App\Models\StockAlocation;
use App\Models\StockCard;
use App\Models\Unit;
use App\Models\Warehouses;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Alokasi extends Component
{
    use LivewireAlert;
    public $product;
    public $alocations;
    public $unitConversions;
    public $templateAlokasiUnit;
    public $templateAlokasiSatuan;
    public $templateAlokasiStatus;
    public $templateQtyAwal = 0;
    public $templateQtyMinimal = 0;
    public $templateQtyMaximal;

    public function mount()
    {
        $getStatusActive = $this->unitConversions->filter(function ($status) {
            return $status->status === 1;
        });

        $this->unitConversions = $getStatusActive;

        $this->loadAlocations();
    }

    public function addAlocation()
    {
        $this->validate(
            [
                'templateAlokasiUnit' => 'required',
                'templateAlokasiSatuan' => 'required',
                'templateQtyMinimal' => 'nullable|min:0|numeric',
                'templateQtyMaximal' => 'required|min:0|numeric',
                'templateAlokasiStatus' => 'required',
            ],
            [
                'templateAlokasiUnit.required' => 'Harap pilih unit alokasi.',
                'templateAlokasiSatuan.required' => 'Harap pilih satuan aktif',
                'templateQtyMinimal.numeric' => 'Harap masukan angka.',
                'templateQtyMaximal.required' => 'Harap masukan maksimal qty.',
                'templateQtyMinimal.min' => 'Faktor konversi minimal adalah 0 (satu).',
                'templateQtyMaximal.min' => 'Faktor konversi minimal adalah 0 (satu).',
                'templateAlokasiStatus.required' => 'Harap pilih status.',
            ]
        );

        $unit = ProductUnit::with('unit')
            ->where('product_id', $this->product->id)
            ->where('product_unit_id', $this->templateAlokasiSatuan)
            ->first();

        // kalau blm dibuat lanjutkan
        DB::beginTransaction();
        try {
            $stockAlocation = StockAlocation::create([
                'product_id' => $this->product->id,
                'location_id' => $this->templateAlokasiUnit,
                'product_unit_id' => $this->templateAlokasiSatuan,
                'quantity_awal' => ($this->templateQtyAwal / $unit->conversion_factor) ?? 0,
                'minimal_stock' => $this->templateQtyMinimal,
                'maximal_stock' => $this->templateQtyMaximal,
                'quantity' => $this->templateQtyAwal / $unit->conversion_factor,
                'status' => $this->templateAlokasiStatus
            ]);

            if ($this->templateQtyAwal > 0) {
                StockCard::create([
                    'product_id' => $this->product->id,
                    'warehouse_id' => $this->templateAlokasiUnit,
                    'product_unit_id' => $this->product->base_unit_id,
                    'movement_type' => 'In',
                    'qty_awal' => 0,
                    'qty' => $this->templateQtyAwal,
                    'qty_akhir' => $this->templateQtyAwal,
                    'desc' => 'stock awal',
                    'reference_type' => 'App\Models\StockAlocation',
                    'reference_id' => $this->product->id,
                    'transaction_date' => $stockAlocation->created_at,
                    'user_proccess_id' => auth()->user()->id,
                ]);
            }

            //jika status aktif penjualan atau aktif unit dan aktif penjualan maka buatkan harganya
            if ($this->templateAlokasiStatus == 2 || $this->templateAlokasiStatus == 3) {
                //cek apakah satuan besar dan kecil sama nilainya
                if ($this->product->base_warehouse_unit_id === $this->product->base_unit_id) {
                    ProductPrice::create([
                        'warehouse_id' => $stockAlocation->location_id,
                        'product_id' => $stockAlocation->product_id,
                        'product_unit_id' => $this->product->base_unit_id,
                        'cost_price' => ($this->product->base_unit->conversion_factor * $this->product->base_cost_price),
                        'selling_price' => 0,
                        'sell_online' => 1,
                        'status' => 1,
                    ]);
                } else {
                    //cari  nilai konversi dibawahnya
                    $unitConversion = ProductUnit::with('unit')
                        ->where('product_id', $stockAlocation->product_id)
                        ->where('conversion_factor', '<=', $unit->conversion_factor)
                        ->get();

                    if (count($unitConversion) === 0) {
                        DB::rollBack();
                        Toaster::error('Satuan tidak ditemukan saat pembuatan harga produk!');
                        return false;
                    } else {
                        foreach ($unitConversion as $index => $value) {
                            ProductPrice::create([
                                'warehouse_id' => $stockAlocation->location_id,
                                'product_id' => $stockAlocation->product_id,
                                'product_unit_conversion_id' => $value->id,
                                'product_unit_id' => $value->product_unit_id,
                                'cost_price' => ($value->conversion_factor * $this->product->base_cost_price),
                                'selling_price' => 0,
                                'sell_online' => 1,
                                'status' => 1,
                            ]);
                        }
                    }
                }
                $this->dispatch('price-created');
            }
            DB::commit();
            $this->templateAlokasiUnit = null;
            $this->templateAlokasiSatuan = null;
            $this->templateAlokasiStatus = null;
            $this->templateQtyAwal = null;
            $this->templateQtyMinimal = null;
            $this->templateQtyMaximal = null;
            $this->loadAlocations();
            // $this->statuses = collect($this->unitConversions)->pluck( 'status', 'id')->map(fn($status) => (bool) $status)->toArray();
            Toaster::success('Alokasi unit ditambahkan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Toaster::warning($e->getMessage());
        }
    }

    #[On('unit-conversion-created')]
    #[On('unit-conversion-deleted')]
    #[On('unit-conversion-update-status')]
    public function loadUnitConversions()
    {
        $this->unitConversions =  ProductUnit::where('product_id', $this->product->id)
            ->where('status', 1)
            ->get();
    }

    public function loadAlocations()
    {
        return $this->alocations = StockAlocation::with('product', 'warehouse', 'unit')
            ->where('product_id', $this->product->id)
            ->get();
    }

    public function render()
    {
        $alocations = array_values(StockAlocation::where('product_id', $this->product->id)
            ->pluck('location_id')
            ->toArray());

        $warehouses = Warehouses::where('status', 1)
            // ->whereNotIn('id', $alocation)
            ->where('business_id', auth()->user()->current_active_business_id)
            ->when(!empty($alocations), function ($query) use ($alocations) {
                return $query->orderByRaw("CASE WHEN id NOT IN (" . implode(',', $alocations) . ") THEN 0 ELSE 1 END");
            })
            ->orderBy('name')
            ->get();

        return view('livewire.dashboard.inventory.product.alokasi.alokasi', [
            'warehouses' => $warehouses,
            'is_alocations' => $alocations
        ]);
    }
}
