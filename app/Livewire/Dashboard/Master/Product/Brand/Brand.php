<?php

namespace App\Livewire\Dashboard\Master\Product\Brand;

use App\Models\Brand as ModelsBrand;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Brand extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search = '';
    public $perPage;
    public $edit = false;
    public $brand_id;

    public function deleteUnit($id)
    {
        //cek apakah ada product yang sudah  memkai satuan ini
        $product = Product::where('brand_id', $id)->first();  
        
        if($product){
            Toaster::error('Brand ini masih dipakai oleh produk');
            return false;
        }else{
            $brand = ModelsBrand::find($id);
            $this->confirm('Hapus Brand?', [
                'text' => 'Brand '.$brand->name.' akan dihapus',
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
        ModelsBrand::find($data['id'])->delete();
        Toaster::success('Brand berhasil dihapus!');

        $this->updateListUnit();

    }

    public function editBrand($id)
    {
        $this->edit = true;
        $this->brand_id = $id;
    }

    #[On('edit-canceled')]
    public function canceledEdit()
    {
        $this->edit = false;
    }

    #[On('brand-created')]
    #[On('brand-updated')]
    public function updateListBrand()
    {
        $this->edit = false;
    }

    public function updatingSearch()
    {
        // Reset halaman saat input pencarian berubah
        $this->resetPage();
    }

    public function render()
    {
        $brands = ModelsBrand::orderBy('name')
            ->where('name', 'ilike', '%'. $this->search .'%')
            ->paginate($this->perPage)
            ->withQueryString();

        return view('livewire.dashboard.master.product.brand.brand', [
            'brands' => $brands
        ]);
    }
}
