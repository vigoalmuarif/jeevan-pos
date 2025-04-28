<?php

namespace App\Livewire\Dashboard\Inventory\Product\KonversiUnit;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\StockAlocation;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class KonversiUnit extends Component
{
    use LivewireAlert;
    public $units;
    public $slug;
    public $product;
    public $templateConversionFromUnit;
    public $templateConversionFactor;
    public $unitConversions;
    public $statuses = [];

    public function mount()
    {
        $this->statuses = collect($this->unitConversions)->pluck( 'status', 'id')->map(fn($status) => (bool) $status)->toArray();

        // dd($this->statuses);
    }


    public function handleStatusConversion($id)
    {
        DB::beginTransaction();
        try {
            $product_unit = ProductUnit::find($id);
            $product_unit->status = !$product_unit->status;
            $product_unit->save();
            DB::commit();
            // Update array agar UI tetap sinkron
            $this->statuses[$id] = $product_unit->status;
            $this->dispatch('unit-conversion-update-status');
            Toaster::success('Status konversi satuan ' . ($product_unit->status ? 'diaktifkan' : 'dinonaktifkan') . '!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toaster::warning('Terjadi kesalahan Sistem, Coba lagi!');
        }

    }


    public function addConversion()
    {
        $this->validate(
            [
                'templateConversionFromUnit' => 'required',
                'templateConversionFactor' => 'required|min:1|numeric',
            ],
            [
                'templateConversionFromUnit.required' => 'Harap pilih satuan asal.',
                'templateConversionFactor.required' => 'Harap masukan faktor konversi.',
                'templateConversionFactor.min' => 'Faktor konversi minimal adalah 1 (satu).',
            ]
        );

        $from_unit = Unit::find($this->templateConversionFromUnit);

        //cek apakah product sudah memkai konversi satuan ini
        $product_unit = ProductUnit::where('product_id', $this->product->id)
            ->where('product_unit_id', $from_unit->id)
            // ->where('to_unit_id', $to_unit->id)
            ->first();
        if ($product_unit) {
            Toaster::warning('Konversi satuan sudah ada!');
            return false;
        }

        // kalau blm dibuat lanjutkan
        DB::beginTransaction();
        try {
            $insert = ProductUnit::create([
                'product_id' => $this->product->id,
                'product_unit_id' => $from_unit->id,
                'conversion_factor' => $this->templateConversionFactor,
                'is_reversible' => 0,
                'status' => 1,
            ]);

            DB::commit();
            $this->loadUnitsConversions();
            $this->statuses = collect($this->unitConversions)->pluck( 'status', 'id')->map(fn($status) => (bool) $status)->toArray();
            $this->dispatch('unit-conversion-created');
            Toaster::success('Konversi satuan berhasil ditambahkan!');

        } catch (\Throwable $e) {
            DB::rollBack();
            Toaster::warning($e->getMessage());
        }

        // $this->conversions[] = [
        //     'from_unit_id' => $from_unit->id,
        //     'from_unit_name' => $from_unit->name,
        //     'to_unit_id' => $from_unit->id,
        //     'to_unit_name' => $to_unit->name,
        //     'conversion_factor' => $this->templateConversionFactor,
        // ];

        $this->templateConversionFromUnit = null;
        $this->templateConversionFactor = null;
    }

    public function deleteConversion($id)
    {
        $unitConversion = ProductUnit::find($id);

        //apakah satuan sudah digunakan pada alokasi
        $alocation = StockAlocation::where('product_id', $unitConversion->product_id)
            ->where('product_unit_id', $unitConversion->from_unit_id)
            ->first();
        if($alocation){
            Toaster::warning('Terdapat alokasi yang menggunakan satuan '. $unitConversion->from_unit->name .'. Satuan tidak dapat dihapus!');
            return false;
        }
        
        $this->confirm('Hapus Konversi Satuan?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Tidak',
            'onConfirmed' => 'confirmedDeleteConversion',
            'data' => [
                'data' => $unitConversion
            ]
        ]);
    }

    #[On('confirmedDeleteConversion')]
    public function confirmDeleteConversion($data)
    {
        ProductUnit::find($data['data']['id'])->delete();

        $this->loadUnitsConversions();
        $this->dispatch('unit-conversion-created');
        Toaster::success('Konversi satuan berhasil dihapus!');
    }


    public function loadUnitsConversions()
    {
        return $this->unitConversions = ProductUnit::with('unit')->where('product_id', $this->product->id)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.inventory.product.konversi-unit.konversi-unit');
    }
}
