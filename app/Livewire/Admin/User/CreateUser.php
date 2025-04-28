<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\Dashboard\UserForm;
use Illuminate\Support\Facades\Redirect;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class CreateUser extends ModalComponent
{
    public UserForm $form;

    public function save()
    {
         $this->form->store();
         $this->closeModal();
         Toaster::success('Yeyy....User Created!');

         $this->redirectRoute('dashboards.user_managements.users.index');
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.admin.user.create-user');
    }
}
