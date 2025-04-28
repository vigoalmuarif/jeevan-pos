<?php

namespace App\Livewire\Dashboard\Inventory\Product;

use App\Livewire\Forms\Invetory\ProductForm;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class CreateProduct extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public ProductForm $form;

    public $templateConversionFromUnit;
    public $templateConversionToUnit;
    public $templateConversionFactor;

    public $conversions = [];

    public int $maxUploadItem;

    public $satuanAwalLabel = '-';

    // public $images = [];

    public function mount()
    {
        $this->maxUploadItem = 4;
    }

    public function generateSku()
    {
        $productName = $this->form->name;
        $generateSku =  generateSku($productName);
        $this->form->sku = $generateSku;
    }

    public function removeImageProduct($index)
    {
        if (isset($this->form->images[$index])) {
            $this->form->images[$index]->delete(); // Hapus dari Livewire
            unset($this->form->images[$index]); // Hapus dari array
            $this->form->images = array_values($this->form->images); // Reset indeks array
        }
    }


    public function addConversion()
    {
        $this->validate(
            [
                'templateConversionFromUnit' => 'required',
                'templateConversionToUnit' => 'required',
                'templateConversionFactor' => 'required|min:1|numeric',
            ],
            [
                'templateConversionFromUnit.required' => 'Harap pilih satuan asal.',
                'templateConversionToUnit.required' => 'Harap pilih satuan tujuan.',
                'templateConversionFactor.required' => 'Harap masukan faktor konversi.',
                'templateConversionFactor.min' => 'Faktor konversi minimal adalah 1 (satu).',
            ]
        );

        $from_unit = Unit::find($this->templateConversionFromUnit);
        $to_unit = Unit::find($this->templateConversionToUnit);

        if ($from_unit->id === $to_unit->id) {
            Toaster::warning('Satuan awal dan satuan tujuan tidak boleh sama!');
            return false;
        }

        $this->conversions[] = [
            'from_unit_id' => $from_unit->id,
            'from_unit_name' => $from_unit->name,
            'to_unit_id' => $from_unit->id,
            'to_unit_name' => $to_unit->name,
            'conversion_factor' => $this->templateConversionFactor,
        ];

        $this->templateConversionFromUnit = null;
        $this->templateConversionToUnit = null;
        $this->templateConversionFactor = null;
    }

    public function deleteConversion($index)
    {
        $this->confirm('Hapus Konversi Satuan?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Tidak',
            'onConfirmed' => 'confirmedDeleteConversion',
            'data' => [
                'index' => $index
            ]
        ]);
    }

    #[On('confirmedDeleteConversion')]
    public function confirmDeleteConversion($data)
    {
        unset($this->conversions[$data['index']]);
    }

    public function save()
    {

        $this->form->store();

        if (session('error')) {
            Toaster::warning(session('error'));
        } else {
            return Redirect::route('dashboards.inventories.products.show', Str::of($this->form->name)->slug('-'))
            ->success('👌' .' '.session('success')); // 👈
        }
    }

    public function satuanAwal()
    {
        $unit = Unit::find($this->form->base_warehouse_unit_id);
        $this->satuanAwalLabel = $unit->name;
    }
    public function render()
    {
        $warehouses = Warehouses::select('id', 'warehouse_code', 'name', 'type')
            ->where('status', 1)
            ->where('business_id', auth()->user()->current_active_business_id)
            ->orderBy('name')
            ->get();
        $brands = Brand::where('status', 1)->where('business_id', auth()->user()->current_active_business_id)->orderBy('name')->get();
        $categories = Category::where('status', 1)->where('business_id', auth()->user()->current_active_business_id)->orderBy('name')->get();
        $units = Unit::where('status', 1)->where('business_id', auth()->user()->current_active_business_id)->orderBy('id')->get();
        $suppliers = Supplier::where('status', 1)->where('business_id', auth()->user()->current_active_business_id)->orderBy('name')->get();

        return view('livewire.dashboard.inventory.product.create-product', [
            'warehouses' => $warehouses,
            'brands' => $brands,
            'categories' => $categories,
            'units' => $units,
            'suppliers' => $suppliers
        ]);
    }
}
