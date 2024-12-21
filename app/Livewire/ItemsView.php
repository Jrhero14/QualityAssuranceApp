<?php

namespace App\Livewire;

use Livewire\Component;

class ItemsView extends Component
{
    public $currentUrl = '/items-database';

    public function render()
    {
        return view('livewire.items-view');
    }
}
