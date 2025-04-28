<?php

namespace App\Livewire\Dashboard\Master\Product\Category;

use App\Models\Category as ModelsCategory;
use App\Models\ProductCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Category extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search = '';
    public $perPage;
    public $edit = false;
    public $category = null;

    public function deleteCategory($id)
    {
        //cek apakah ada product yang sudah  memkai category ini
        $product = ProductCategory::select('category_id')->where('category_id', $id)->first();

        if ($product) {
            Toaster::error('Kategori ini masih dipakai oleh produk');
            return false;
        } else {

            $this->confirm('Hapus Kategori?', [
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
        ModelsCategory::find($data['id'])->delete();
        Toaster::success('Kategori berhasil dihapus!');

        $this->updateListCategory();
    }

    public function editCategory($id)
    {
        $this->edit = true;
        $this->category = $id;
    }


    #[On('edit-canceled')]
    public function canceledEdit()
    {
        $this->edit = false;
    }

    #[On('category-created')]
    #[On('category-updated')]
    public function updateListCategory()
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
        $categories = ModelsCategory::orderBy('name')
            ->where('name', 'ilike', '%' . $this->search . '%')
            ->orWhere('category_code', 'ilike', '%' . $this->search . '%')
            ->paginate($this->perPage)
            ->withQueryString();
        return view('livewire.dashboard.master.product.category.category', [
            'categories' => $categories
        ]);
    }
}
