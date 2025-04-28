<?php

namespace App\Livewire\Dashboard\Master\Warehouse;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Purchase;
use App\Models\Warehouses;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Warehouse extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search = '';
    public $perPage;

    public function createWarehouse()
    {
        $this->dispatch('openModal', component : 'dashboard.master.warehouse.create-warehouse');
    }


    public function deleteUnit($id)
    {
        //ambil data yang berhubungan dengan warehouse
        $warehouse = Warehouses::
            with(['users', 'purchases', 'stock_batches', 'product_prices'])
            ->select('warehouses.id')
            ->where('warehouses.id', $id)
            ->first(); 
        


        if(count($warehouse->purchases) > 0 ){
            Toaster::warning($warehouse->type . ' ' . $warehouse->name . ' telah memiliki riwayat pembelian. Data tidak dapat dihapus!');
            return false;
        }

        if(count($warehouse->stock_batches) > 0  || count($warehouse->product_prices) > 0){
            Toaster::warning($warehouse->type . ' ' . $warehouse->name . ' telah memiliki produk. Data tidak dapat dihapus!');
            return false;
        }

        if(count($warehouse->users) > 0 ){
            Toaster::warning($warehouse->type . ' ' . $warehouse->name . ' telah memiliki karyawan. Data tidak dapat dihapus!');
            return false;
        }
        

        $this->confirm('Hapus '.$warehouse->type.'?', [
            'text' => 'Data yang berkaitan dengan '.$warehouse->type.' akan ikut terhapus dan tidak bisa dikembalikan!',
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Jangan',
            'onConfirmed' => 'confirmedDelete',
            'data' => [
                'id' => $id
            ]
        ]);
    }

    #[On('confirmedDelete')]
    public function confirmedDelete($data)
    {
        Warehouses::find($data['id'])->delete();
        Toaster::success('Data berhasil dihapus!');

        $this->updateListUnit();

    }


    #[On('warehouse-created')]
    #[On('warehouse-updated')]
    public function updateListWarehouse()
    {
    }

    public function updatedSearch()
    {
        // Reset halaman saat input pencarian berubah
        $this->resetPage();
    }
    
    public function render()
    {
        $warehouses = Warehouses::orderBy('name')
            ->where('name', 'ilike', '%'. $this->search .'%')
            ->Orwhere('type', 'ilike', '%'. $this->search .'%')
            ->paginate($this->perPage)
            ->withQueryString();

        return view('livewire.dashboard.master.warehouse.warehouse', [
            'warehouses' => $warehouses
        ]);
    }
}
