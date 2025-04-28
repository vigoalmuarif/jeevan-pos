<?php

namespace App\Livewire\Forms\Dashboard\Master\Product;

use App\Models\Unit;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    public ?Unit $unit;

    public $unit_id = null;
    
    #[Validate]
    public $name;
    public $status = 1;
    

    protected function rules() 
    {
        return [
            'name' => [
                'required',
                Rule::unique('product_units', 'name')->ignore($this->unit_id)
            ]
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama satuan.',
            'name.unique' => 'Nama satuan sudah digunakan.',
          
        ];
    }

    public function setUnit(Unit $unit)
    {
        $this->unit = $unit;
        $this->unit_id = $unit->id;
        $this->name = $this->unit->name;
        $this->status = $this->unit->status == 'Active' ? true : false;
    }

    public function update()
    {
        $this->validate();
        
        $this->unit->update([
            'name'=> $this->name,
            'status' => $this->status === true ? 1 : 0
        ]);
    }

    public function store()
    {
        $this->validate();

        Unit::create([
            'name'=> $this->name,
            'business_id' => auth()->user()->current_active_business_id,
            'status' => $this->status
        ]);
    }
}
