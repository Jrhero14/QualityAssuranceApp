<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $currentUrl = '/admin/users/create';
    public $name, $email, $password, $confirm_password, $role;

    protected $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:supervisor,operator',
    ];

    public function submit()
    {
        if ($this->password !== $this->confirm_password) {
            $this->addError('confirm_password', 'Konfirmasi password tidak cocok.');
            return;
        }

        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);

        session()->flash('create-user-success', true);
        return redirect()->route('users.index');
    }

}
