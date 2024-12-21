<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardPage extends Component
{
    public $currentUrl = '/dashboard';
    public function render()
    {
        return view('livewire.dashboard-page');
    }
}
