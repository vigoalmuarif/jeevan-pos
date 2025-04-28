<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Forms\Dashboard\RoleForm;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class RolePermision extends ModalComponent
{
    public RoleForm $form;

    public Role $role;
    public $selectedPermissions= [];
    public $search;

    public $perPage;


    public function mount()
    {

        $this->selectedPermissions = $this->role->permissions->pluck('name')->toArray();
    }

    public function togglePermission($name)
    {
        $data = [
            'role_id' => $this->role->id,
            'permission_name' => $name
        ];
        $this->form->setPermision($data);
        // $this->selectedPermissions = $this->role->permissions->pluck('name')->toArray();
        Toaster::success(session('status'));
    }


    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    // public function updatingSearch()
    // {

    //     $this->selectedPermissions = [];
    // }

    public function updatedSearch()
    {

        $this->selectedPermissions = $this->role->permissions->pluck('name')->toArray();
    }


    public function render()
    {
        $data['permissions'] = Permission::where('name', 'ilike', '%'. $this->search .'%')
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.admin.role.role-permision', $data);
    }
}
