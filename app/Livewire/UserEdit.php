<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $userId;
    public $name, $email, $password, $confirm_password, $role;

    public function mount(User $user)
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6',
            'role' => 'required|in:supervisor,operator',
        ];
    }

    public function submit()
    {
        if ($this->password && $this->password !== $this->confirm_password) {
            $this->addError('confirm_password', 'Konfirmasi password tidak cocok.');
            return;
        }

        $validated = $this->validate();

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;

        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        $user->save();

        session()->flash('update-user-success', true);
    }
}
