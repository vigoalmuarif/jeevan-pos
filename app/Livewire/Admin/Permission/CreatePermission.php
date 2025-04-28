<?php

namespace App\Livewire\Admin\Permission;

use App\Livewire\Forms\Dashboard\PermissionForm;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CreatePermission extends Component
{
    public PermissionForm $form;

    public function createPermission()
    {
        $this->form->store();
        return Redirect::route('dashboards.user_managements.permissions.index')
        ->success('Permission Created!'); 
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.permission.create-permission');
    }
}
