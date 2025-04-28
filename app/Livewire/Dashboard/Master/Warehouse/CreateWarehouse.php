<?php

namespace App\Livewire\Dashboard\Master\Warehouse;

use App\Livewire\Forms\Dashboard\Master\WarehouseForm;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class CreateWarehouse extends ModalComponent
{
    public WarehouseForm $form;

    public function save()
    {
        $this->form->store();

        $this->closeModal();
        $type = $this->form->type;
        $this->dispatch('warehouse-created');
        Toaster::success($type. ' berhasil dibuat!');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }


    public function render()
    {
        // $users = User::where('employee_position_id', '!=', null)->get();
        $users = User::get();
        return view('livewire.dashboard.master.warehouse.create-warehouse',[
            'users' => $users
        ]);
    }
}
