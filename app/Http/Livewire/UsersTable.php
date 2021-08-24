<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'name';
    public $sortAsc = true;
    public $search = '';
    public $searchUserType = '';

    protected $listeners = ['refreshUsersTable'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function paginationView()
    {
        return 'includes._pagination';
    }

    public function updatingSearch()
    {
        // Method from Livewire by default
        $this->resetPage();
    }

    public function refreshUsersTable()
    {
        $this->perPage = 10;
        $this->search = '';
        $this->searchUserType = '';
        $this->sortField = 'name';
        $this->sortAsc = true;
    }

    public function render()
    {
        $users = User::search($this->search)
            ->withType($this->searchUserType)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.users-table', [
            'users' => $users
        ]);
    }
}
