<?php

namespace App\Livewire\Forms\Dashboard;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Form
{
    #[Validate]
    public $name;
    public $guard_name = 'web';

    protected function rules() 
    {
        return [
            'name' => 'required|unique:roles,name',
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama permission.',
            'name.unique' => 'Permission sudah digunakan.',
          
        ];
    }

    public function store()
    {
        $this->validate();

        Permission::create($this->all());

        $this->reset();
        $this->resetValidation();
    }
}
