<?php

namespace App\Livewire\Admin\User;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    
    // #[Url(as: 'cursor')]
    public $search = '';
    public $perPage;
    // protected $queryString = ['search'];

    public function updatingSearch()
    {
        // Reset halaman saat input pencarian berubah
        $this->resetPage();
    }

    public function createUser()
    {
        $this->dispatch('openModal', component : 'admin.user.create-user');
    }
    public function render()
    {
        $data['users'] = ModelsUser::where('name', 'like', '%'. $this->search .'%')
            ->where('username', 'ilike', '%'. $this->search .'%')
            ->orWhere('email', 'ilike', '%'. $this->search .'%')
            ->orWhere('phone', 'ilike', '%'. $this->search .'%')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);
        return view('livewire.admin.user.user', $data);
    }
}
