<?php

namespace App\Livewire\Dashboard\Master\Product\Category;

use App\Livewire\Forms\Dashboard\Master\Product\CategoryForm;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditCategory extends Component
{
    public CategoryForm $form;

    public $category;

    public function mount(Category $category)
    {
        $this->form->reset();
        $this->form->setCategory($category);
    }

    public function cancelEdit()
    {
        $this->dispatch('edit-canceled');
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('category-updated');
        Toaster::success('Kategori berhasil diubah!');
    }


    public function render()
    {
        return view('livewire.dashboard.master.product.category.edit-category');
    }
}
