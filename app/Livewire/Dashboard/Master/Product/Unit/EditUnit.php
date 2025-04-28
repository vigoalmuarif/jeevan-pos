<?php

namespace App\Livewire\Dashboard\Master\Product\Unit;

use App\Livewire\Forms\Dashboard\Master\Product\UnitForm;
use App\Models\Unit;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditUnit extends Component
{
    public UnitForm $form;

    public $unitId;


    public function mount(Unit $unitId)
    {
        $this->form->setUnit($unitId);
    }

    public function cancelEdit()
    {
        $this->dispatch('edit-canceled');
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('unit-updated');
        Toaster::success('Satuan berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.dashboard.master.product.unit.edit-unit');
    }
}
