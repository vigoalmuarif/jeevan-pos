<?php

namespace App\Livewire\Dashboard\Master\Product\Brand;

use App\Livewire\Forms\Dashboard\Master\Product\BrandForm;
use App\Models\Brand;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditBrand extends Component
{
    public BrandForm $form;

    public $brandId;


    public function mount(Brand $brandId)
    {
        $this->form->setBrand($brandId);
    }

    public function cancelEdit()
    {
        $this->dispatch('edit-canceled');
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('brand-updated');
        Toaster::success('Merk berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.dashboard.master.product.brand.edit-brand');
    }
}
