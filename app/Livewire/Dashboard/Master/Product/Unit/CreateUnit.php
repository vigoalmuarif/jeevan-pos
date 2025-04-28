<?php

namespace App\Livewire\Dashboard\Master\Product\Unit;

use App\Livewire\Forms\Dashboard\Master\Product\UnitForm;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CreateUnit extends Component
{
    public UnitForm $form;

    public function createUnit()
    {
        $this->form->store();

        $this->dispatch('unit-created');

        $this->form->reset();
        $this->resetValidation();

        Toaster::success('Satuan berhasil ditambahkan!');
    }

    public function resetCreateForm()
    {
        $this->form->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.master.product.unit.create-unit');
    }
}
