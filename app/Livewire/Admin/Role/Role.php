<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role as ModelsRole;
use Livewire\Component;
use Livewire\WithPagination;

class Role extends Component
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
        $this->dispatch('openModal', component : 'admin.role.role-permision', arguments: ['role' => $id]);
    }

    public function render()
    {
        $data['roles'] = ModelsRole::where('name', 'ilike', '%'. $this->search .'%')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

    
        return view('livewire.admin.role.role', $data);
    }
}
