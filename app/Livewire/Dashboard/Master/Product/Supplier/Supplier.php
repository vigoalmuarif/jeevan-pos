<?php

namespace App\Livewire\Dashboard\Master\Product\Supplier;

use App\Models\Supplier as ModelsSupplier;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Supplier extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search = '';
    public $perPage;

    public function createWarehouse()
    {
        $this->dispatch('openModal', component : 'dashboard.master.product.supplier.create-supplier');
    }


    // public function deleteUnit($id)
    // {
    //     //ambil data yang berhubungan dengan warehouse
    //     $warehouse = Warehouses::
    //         with(['users', 'purchases', 'stock_batches', 'product_prices'])
    //         ->select('warehouses.id')
    //         ->where('warehouses.id', $id)
    //         ->first(); 
        


    //     if(count($warehouse->purchases) > 0 ){
    //         Toaster::warning($warehouse->type . ' ' . $warehouse->name . ' telah memiliki riwayat pembelian. Data tidak dapat dihapus!');
    //         return false;
    //     }

    //     if(count($warehouse->stock_batches) > 0  || count($warehouse->product_prices) > 0){
    //         Toaster::warning($warehouse->type . ' ' . $warehouse->name . ' telah memiliki produk. Data tidak dapat dihapus!');
    //         return false;
    //     }

    //     if(count($warehouse->users) > 0 ){
    //         Toaster::warning($warehouse->type . ' ' . $warehouse->name . ' telah memiliki karyawan. Data tidak dapat dihapus!');
    //         return false;
    //     }
        

    //     $this->confirm('Hapus '.$warehouse->type.'?', [
    //         'text' => 'Data yang berkaitan dengan '.$warehouse->type.' akan ikut terhapus dan tidak bisa dikembalikan!',
    //         'showConfirmButton' => true,
    //         'showCancelButton' => true,
    //         'confirmButtonText' => 'Hapus',
    //         'cancelButtonText' => 'Jangan',
    //         'onConfirmed' => 'confirmedDelete',
    //         'data' => [
    //             'id' => $id
    //         ]
    //     ]);
    // }

    // #[On('confirmedDelete')]
    // public function confirmedDelete($data)
    // {
    //     Warehouses::find($data['id'])->delete();
    //     Toaster::success('Data berhasil dihapus!');

    //     $this->updateListUnit();

    // }


    #[On('supplier-created')]
    #[On('supplier-updated')]
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
        $suppliers = ModelsSupplier::where('name', 'like', '%' . $this->search . '%')->paginate($this->perPage);
        return view('livewire.dashboard.master.product.supplier.supplier',[
            'suppliers' => $suppliers
        ]);
    }
}
