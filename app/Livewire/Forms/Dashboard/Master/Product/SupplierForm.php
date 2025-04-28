<?php

namespace App\Livewire\Forms\Dashboard\Master\Product;

use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierForm extends Form
{
    #[Validate]
    public $name, $supplier_code, $address, $phone, $status = 1;
    
    public $supplier;
    public $supplier_id;

    protected function rules() 
    {
        return [
            'supplier_code' => [
                'required',
                Rule::unique('suppliers', 'supplier_code')->ignore($this->supplier_id)
            ],
            'name' => [
                'required',
                Rule::unique('suppliers', 'name')->ignore($this->supplier_id)
            ],
            'phone' => 'nullable|numeric',

        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama supplier.',
            'name.unique' => 'Nama supplier sudah ada.',
            'supplier_code.required' => 'Harap masukan kode supplier.',
            'supplier_code.unique' => 'Kode supplier sudah digunakan.',
            'phone.numeric' => 'Nomor telepon tidak valid.',
          
        ];
    }

    public function setWarehouse(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->supplier_id = $supplier->id;
        $this->name = $this->supplier->name;
        $this->status = $this->supplier->status == 'Active' ? true : false;
    }

    public function update()
    {
        $this->validate();
        
        $this->supplier->update([
            'name'=> $this->name,
            'status' => $this->status === true ? 1 : 0
        ]);
    }

    public function store()
    {
        $this->validate();

        Supplier::create([
            'name'=> $this->name,
            'business_id' => auth()->user()->current_active_business_id,
            'supplier_code' => $this->supplier_code,
            'address' => $this->address,
            'phone' => $this->phone,
            'status' => $this->status
        ]);
    }
}
