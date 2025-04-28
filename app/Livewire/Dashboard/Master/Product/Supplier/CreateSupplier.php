<?php

namespace App\Livewire\Dashboard\Master\Product\Supplier;

use App\Livewire\Forms\Dashboard\Master\Product\SupplierForm;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class CreateSupplier extends ModalComponent
{
    public SupplierForm $form;

    public function save()
    {
        $this->form->store();

        $this->closeModal();
        $this->dispatch('supplier-created');
        Toaster::success('Supplier berhasil ditambahkan!');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('livewire.dashboard.master.product.supplier.create-supplier');
    }
}
