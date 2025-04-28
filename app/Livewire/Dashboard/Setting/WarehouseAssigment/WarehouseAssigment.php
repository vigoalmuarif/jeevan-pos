<?php

namespace App\Livewire\Dashboard\Setting\WarehouseAssigment;

use App\Models\BranchWarehouse;
use App\Models\Warehouses;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class WarehouseAssigment extends Component
{
    use LivewireAlert;

    public function create()
    {
        $this->dispatch('openModal', component: 'dashboard.setting.warehouse_assigment.create_warehouse_assigment');
    }

    #[On('warehouse-assigment-created')]
    #[On('warehouse-assigment-updated')]
    public function updateList() {}

    public function edit($id) 
    {
        // dd($id);
        $this->dispatch('edit-warehouse-assigment', data: ['warehouseAssigmentID' => $id]);
    }
    public function delete($id) 
    {
        $this->confirm('Hapus Cabang Dari Distriubsi Gudang?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Tidak',
            'onConfirmed' => 'confirmedDeleteWarehouseAssigment',
            'data' => [
                'id' => $id
            ]
        ]);
    }

    #[On('confirmedDeleteWarehouseAssigment')]
    public function confirmDeleteWarehouseAssigment($data)
    {
        $warehouseAssigment = BranchWarehouse::find($data['id'])->delete();
        Toaster::success('Distribusi Gudang Berhasil Dihapus!');
        $this->updateList();
    }

    public function render()
    {
        $warehouses = Warehouses::with('branches')
            ->where('business_id', auth()->user()->current_active_business_id)
            ->where('type', 'Warehouse')
            ->get();

        return view('livewire.dashboard.setting.warehouse-assigment.warehouse-assigment', [
            'warehouses' => $warehouses
        ]);
    }
}
