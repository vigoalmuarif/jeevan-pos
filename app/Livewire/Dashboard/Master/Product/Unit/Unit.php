<?php

namespace App\Livewire\Dashboard\Master\Product\Unit;

use App\Models\Product;
use App\Models\Unit as ModelsUnit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Unit extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search = '';
    public $perPage;
    public $edit = false;
    public $unit_id;

    public function deleteUnit($id)
    {
        //cek apakah ada product yang sudah  memkai satuan ini
        $product = Product::
            select('products.id')
            ->join('product_units', 'product_units.product_id', '=', 'products.id')
            ->where('base_unit_id', $id)
            ->orWhere('from_unit_id', $id) 
            ->orWhere('to_unit_id', $id)->first();  
        
        if($product){
            Toaster::error('Satuan ini masih dipakai oleh produk');
            return false;
        }else{

            $this->confirm('Hapus Satuan?', [
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
    }

    #[On('confirmedDelete')]
    public function confirmedDelete($data)
    {
        ModelsUnit::find($data['id'])->delete();
        Toaster::success('Satuan berhasil dihapus!');

        $this->updateListUnit();

    }

    public function editUnit($id)
    {
        $this->edit = true;
        $this->unit_id = $id;
    }

    #[On('edit-canceled')]
    public function canceledEdit()
    {
        $this->edit = false;
        $this->dispatch('$refresh');
    }

    #[On('unit-created')]
    #[On('unit-updated')]
    public function updateListUnit()
    {
        $this->edit = false;
    }

    public function updatedSearch()
    {
        // Reset halaman saat input pencarian berubah
        $this->resetPage();
    }

    public function render()
    {
        $units = ModelsUnit::orderBy('name')
            ->where('name', 'ilike', '%'. $this->search .'%')
            ->paginate($this->perPage)
            ->withQueryString();

        return view('livewire.dashboard.master.product.unit.unit', [
            'units' => $units
        ]);
    }
}
