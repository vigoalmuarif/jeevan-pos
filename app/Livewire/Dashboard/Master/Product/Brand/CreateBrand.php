<?php

namespace App\Livewire\Dashboard\Master\Product\Brand;

use App\Livewire\Forms\Dashboard\Master\Product\BrandForm;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CreateBrand extends Component
{
    public BrandForm $form;

    public function createBrand()
    {
        $this->form->store();

        $this->dispatch('brand-created');

        $this->form->reset();
        $this->resetValidation();

        Toaster::success('Merk berhasil ditambahkan!');
    }

    public function resetCreateForm()
    {
        $this->form->reset();
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.dashboard.master.product.brand.create-brand');
    }
}
