<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $currentUrl = '/admin/users';

    protected $paginationTheme = 'bootstrap'; // Jika pakai Bootstrap

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('delete-user-success', 'User berhasil dihapus.');
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.users-index', compact('users'));
    }
}
