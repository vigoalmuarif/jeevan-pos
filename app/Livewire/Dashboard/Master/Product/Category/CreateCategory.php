<?php

namespace App\Livewire\Dashboard\Master\Product\Category;

use App\Livewire\Forms\Dashboard\Master\Product\CategoryForm;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CreateCategory extends Component
{
    public CategoryForm $form;

    public function createCategory()
    {
        $this->form->store();

        $this->dispatch('category-created');

        $this->form->reset();
        $this->resetValidation();

        Toaster::success('Kategori berhasil ditambahkan!');
    }

    public function resetCreateForm()
    {
        $this->form->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.master.product.category.create-category');
    }
}
