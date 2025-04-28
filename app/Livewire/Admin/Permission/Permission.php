<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function permission($id)
    {
        $this->dispatch('openModal', component : 'admin.role.role-permision', arguments: ['user' => $id]);
    }

    public function render()
    {
        $data['permissions'] = ModelsPermission::where('name', 'ilike', '%'. $this->search .'%')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

    
        return view('livewire.admin.permission.permission', $data);
    }
}
