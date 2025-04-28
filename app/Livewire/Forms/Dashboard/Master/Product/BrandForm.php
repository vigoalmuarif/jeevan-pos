<?php

namespace App\Livewire\Forms\Dashboard\Master\Product;

use App\Models\Brand;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BrandForm extends Form
{
    public ?Brand $brand;

    public $brand_id;
    
    #[Validate]
    public $name;

    #[Validate]
    public $brand_code;
    public $status = 1;
    

    protected function rules() 
    {
        return [
            'name' => [
                'required',
                Rule::unique('product_brands', 'name')->ignore($this->brand_id)
            ],
            'brand_code' => [
                'required',
                Rule::unique('product_brands', 'brand_code')->ignore($this->brand_id)
            ]
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama merk.',
            'name.unique' => 'Nama merk sudah digunakan.',
            'brand_code.required' => 'Harap masukan kode merk.',
            'brand_code.unique' => 'Kode merk sudah digunakan.',
          
        ];
    }

    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;
        $this->brand_id = $brand->id;
        $this->name = $this->brand->name;
        $this->brand_code = $this->brand->brand_code;
        $this->status = $this->brand->status == 'Active' ? true : false;
    }

    public function update()
    {
        $this->validate();
        
        $this->brand->update([
            'name'=> $this->name,
            'brand_code'=> $this->brand_code,
            'status' => $this->status === true ? 1 : 0
        ]);
    }

    public function store()
    {
        $this->validate();

        Brand::create([
            'name'=> $this->name,
            'business_id' => auth()->user()->current_active_business_id,
            'brand_code'=> $this->brand_code,
            'status' => $this->status
        ]);
    }
}
