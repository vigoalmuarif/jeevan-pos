<?php

namespace App\Livewire\Forms\Dashboard\Master\Product;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category;

    public $category_id = null;
    
    #[Validate]
    public $name;

    #[Validate]
    public $category_code = null;
    public $status = 1;

    
    protected function rules() 
    {
        return [
            'name' => [
                    'required',
                    Rule::unique('product_categories', 'name')->ignore($this->category_id),
                ],
            'category_code' => [
                'required',
                Rule::unique('product_categories', 'category_code')->ignore($this->category_id),
            ]
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama kategori.',
            'name.unique' => 'Nama kategori sudah digunakan.',
            'category_code.required' => 'Harap masukan kode kategori.',
            'category_code.unique' => 'Kode kategori sudah digunakan.',
          
        ];
    }

    public function setCategory(Category $category)
    {
        $this->reset(['category_id', 'name', 'category_code', 'status']); // Hapus nilai lama
        
        $this->category = $category;
        $this->category_id = $category->id;
        $this->name = $this->category->name;
        $this->category_code = $this->category->category_code;
        $this->status = $this->category->status == 'Active' ? true : false;
        
    }

    public function update()
    {
        $this->validate();
        
        $this->category->update([
            'name'=> $this->name,
            'category_code' => $this->category_code,
            'status' => $this->status === true ? 1 : 0
        ]);
    }

    public function store()
    {
        $this->validate();
        
        Category::create([
            'name'=> $this->name,
            'business_id' => auth()->user()->current_active_business_id,
            'category_code' => $this->category_code,
            'status' => $this->status
        ]);
    }
}
