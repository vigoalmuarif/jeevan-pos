<?php

namespace App\Livewire\Forms\Dashboard\Master;

use App\Models\Warehouses;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class WarehouseForm extends Form
{
    #[Validate]
    public $type = 'Branch', $name, $warehouse_code, $location, $address, $phone, $status = 1, $ppic_id;
    
    public $warehouse;
    public $warehouse_id;

    protected function rules() 
    {
        return [
            'warehouse_code' => [
                'required',
                Rule::unique('warehouses', 'warehouse_code')->ignore($this->warehouse_id)
            ],
            'name' => [
                'required',
                Rule::unique('warehouses', 'name')->ignore($this->warehouse_id)
            ],
            'type' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'ppic_id' => 'required'

        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama warehouse/branch.',
            'name.unique' => 'Nama warehouse/branch sudah digunakan.',
            'warehouse_code.required' => 'Harap masukan kode warehouse/branch.',
            'warehouse_code.unique' => 'Kode warehouse/branch sudah digunakan.',
            'type.required' => 'Harap pilih tipe warehouse/branch.',
            'address.required' => 'Harap masukan alamat warehouse/branch.',
            'phone.required' => 'Harap masukan nomor telepon warehouse/branch.',
            'phone.numeric' => 'Nomor telepon tidak valid.',
            'ppic_id.required' => 'Harap pilih PIC warehouse/branch.',
          
        ];
    }

    public function setWarehouse(Warehouses $warehouse)
    {
        $this->warehouse = $warehouse;
        $this->warehouse_id = $warehouse->id;
        $this->name = $this->warehouse->name;
        $this->status = $this->warehouse->status == 'Active' ? true : false;
    }

    public function update()
    {
        $this->validate();
        
        $this->warehouse->update([
            'name'=> $this->name,
            'status' => $this->status === true ? 1 : 0
        ]);
    }

    public function store()
    {
        $this->validate();

        Warehouses::create([
            'name'=> $this->name,
            'slug'=> $this->name ? str()->slug($this->name) : null,
            'business_id' => auth()->user()->current_active_business_id,
            'warehouse_code' => $this->warehouse_code,
            'type' => $this->type,
            'location' => $this->location,
            'address' => $this->address,
            'phone' => $this->phone,
            'ppic_id' => $this->ppic_id,
            'status' => $this->status
        ]);
    }
}
