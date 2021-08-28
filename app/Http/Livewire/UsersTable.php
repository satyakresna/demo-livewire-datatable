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

    protected $listeners = ['refreshUsersTable', 'delete', 'deleteOk', 'deleteError'];

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

    public function deleteConfirm($id, $name)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'Peringatan!',
            'message' => "Anda yakin akan menghapus user {$name}?",
            'id' => $id,
            'name' => $name
        ]);
    }

    public function delete($id, $name)
    {
        // TODO: math random, not actual delete a user
        // then `emit` to another method
        $rand = mt_rand(0, 1);
        if (!empty($rand)) {
            $this->emit('deleteOk', [
                'name' => $name
            ]);
        } else {
            $this->emit('deleteError', [
                'name' => $name
            ]);
        }
    }

    public function deleteOk($data)
    {
        $this->dispatchBrowserEvent('swal:ok', [
            'title' => 'Berhasil!',
            'message' => "User {$data['name']} berhasil dihapus!"
        ]);
    }

    public function deleteError($data)
    {
        $this->dispatchBrowserEvent('swal:error', [
            'title' => 'Gagal!',
            'message' => "User {$data['name']} gagal dihapus!"
        ]);
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
