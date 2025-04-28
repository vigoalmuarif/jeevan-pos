<?php

namespace App\Livewire\Dashboard\Setting\WarehouseAssigment;

use App\Models\BranchWarehouse;
use App\Models\Warehouses;
use Livewire\Attributes\On;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class CreateWarehouseAssigment extends ModalComponent
{
    public $warehouse;
    public $branch;

    public function moun()
    {
        
    }

    public function save()
    {
        $this->validate(
            [
                'warehouse' => 'required',
                'branch' => 'required',
            ],
            [
                'warehouse.required' => 'Harap pilih gudang.',
                'branch.required' => 'Harap pilih cabang.',
            ]
        );

        $cek = BranchWarehouse::where('warehouse_id', $this->warehouse)
            ->where('branch_id', $this->branch)
            ->first();
        
        if($cek){
            Toaster::warning('Gudang sudah mendistribusikan ke cabang tersebut!');
            return;
        }else{
            BranchWarehouse::create([
                'warehouse_id' => $this->warehouse,
                'branch_id' => $this->branch,
                'status' => 1
            ]);
            Toaster::success('Distribusi Gudang Berhasil Ditambahkan!');
            $this->dispatch('warehouse-assigment-created');
        }
    }

    #[On('reset-form-create-warehouse-assigment')]
    public function resetForm()
    {
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

        return view('livewire.dashboard.setting.warehouse-assigment.create-warehouse-assigment',[
            'warehouses' => $warehouses,
            'branches' => $branches
        ]);
    }
}
