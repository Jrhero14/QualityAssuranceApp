<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        if (auth()->check()) {
            $this->redirect('/dashboard');
        }

        return view('livewire.home-page');
    }
}
