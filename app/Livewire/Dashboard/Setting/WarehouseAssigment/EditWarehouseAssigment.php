<?php

namespace App\Livewire\Dashboard\Setting\WarehouseAssigment;

use App\Models\BranchWarehouse;
use App\Models\Warehouses;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditWarehouseAssigment extends Component
{
    public $warehouseEdit;
    public $branchEdit;
    public $statusEdit;
    public $warehouseAssigment;

    #[On('edit-warehouse-assigment')]
    public function fetcWarehouse($data)
    {
        // dd($data);
        $this->warehouseAssigment = BranchWarehouse::find($data['warehouseAssigmentID']);
        $this->warehouseEdit = $this->warehouseAssigment->warehouse_id;
        $this->branchEdit = $this->warehouseAssigment->branch_id;
        $this->statusEdit = $this->warehouseAssigment->status == 1 ? true : false;
        $this->dispatch('openModalEdit');
    }

    public function save()
    {
        $this->validate(
            [
                'warehouseEdit' => 'required',
                'branchEdit' => 'required',
            ],
            [
                'warehouseEdit.required' => 'Harap pilih gudang.',
                'branchEdit.required' => 'Harap pilih cabang.',
            ]
        );

        $cek = BranchWarehouse::where('warehouse_id', $this->warehouseEdit)
            ->where('branch_id', $this->branchEdit)
            ->where('id', '!=', $this->warehouseAssigment->id)
            ->first();
        
        if($cek){
            Toaster::warning('Gudang sudah mendistribusikan ke cabang tersebut!');
            return;
        }else{
            BranchWarehouse::where('id', $this->warehouseAssigment->id)
                ->update([
                    'warehouse_id' => $this->warehouseEdit,
                    'branch_id' => $this->branchEdit,
                    'status' => $this->statusEdit
                ]);
            Toaster::success('Distribusi Gudang Berhasil Diubah!');
            $this->dispatch('warehouse-assigment-updated');
        }
    }

    public function render()
    {

        $warehouses = Warehouses::with('branches')
            ->where('business_id', auth()->user()->current_active_business_id)
            ->where('type', 'Warehouse')
            ->get();
        $branches = Warehouses::with('branches')
            ->where('business_id', auth()->user()->current_active_business_id)
            ->where('type', 'Branch')
            ->get();

        return view('livewire.dashboard.setting.warehouse-assigment.edit-warehouse-assigment', [
            'warehouses' => $warehouses,
            'branches' => $branches
        ]);
    }
}
