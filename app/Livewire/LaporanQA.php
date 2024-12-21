<?php

namespace App\Livewire;

use Livewire\Component;

class LaporanQA extends Component
{
    public $currentUrl = '/laporan-qa';

    public function render()
    {
        return view('livewire.laporan-q-a');
    }
}
