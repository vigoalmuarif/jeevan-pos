<?php

namespace App\Livewire\Forms\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    #[Validate]
    public $name;
    public $guard_name = 'web';
    public $type;


    protected function rules() 
    {
        return [
            'name' => 'required|unique:roles,name',
            'type' => 'required',
        ];
    }

    protected function messages() 
    {
        return [
            'name.required' => 'Harap masukan nama role.',
            'name.unique' => 'Role sudah digunakan.',
            'type.required' => 'Harap pilih role category.',
          
        ];
    }

    public function setPermision($data)
    {
        $role = Role::findOrFail($data['role_id']);
        $check = $role->hasPermissionTo($data['permission_name']);
        if ($check) {
            $role->revokePermissionTo($data['permission_name']);

            session()->flash('status', 'Permission '. $data['permission_name'] . ' berhasil dihapus.');
        }else{
            $role->givePermissionTo($data['permission_name']);

            session()->flash('status', 'Permission '. $data['permission_name'] . ' berhasil diset.');
        }
    }

    public function store()
    {
        $this->validate();

        Role::create($this->only('name', 'guard_name', 'type'));

        $this->reset();
        $this->resetValidation();
    }
}
