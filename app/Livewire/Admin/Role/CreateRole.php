<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Forms\Dashboard\RoleForm;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CreateRole extends Component
{
    public RoleForm $form;

    public function createRole()
    {
        $this->form->store();
        return Redirect::route('dashboards.user_managements.roles.index')
        ->info('Role Created!'); 
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.role.create-role');
    }
}
