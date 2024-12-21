<?php

namespace App\Livewire;

use Livewire\Component;

class Checking extends Component
{
    public $currentUrl = '/checking';
    public $ngChoice;

    public function ngChoiceFun()
    {
        $this->ngChoice = true;
    }

    public function backButton()
    {
        $this->ngChoice = null;
    }

    public function render()
    {
        return view('livewire.checking');
    }
}
