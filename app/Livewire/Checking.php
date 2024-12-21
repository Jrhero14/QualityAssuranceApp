<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Schedule;
use Livewire\Component;

class Checking extends Component
{
    public $currentUrl = '/checking';
    public $ngChoice;

    public $shiftChoice;

    public $shiftSelected;

    public function ngChoiceFun()
    {
        $this->ngChoice = true;
    }

    public function backButton()
    {
        $this->ngChoice = null;
    }

    public function saveShift()
    {
        if (is_null($this->shiftChoice)){
            session()->flash('belum-pilih-shift');
            $this->redirect('/checking');
            return;
        }


    }

    private function checkShift()
    {
        $dateNow = date('Y-m-d');
        $dataSchedule = Schedule::query()->whereDate('tanggal', '=', $dateNow)->get()->first();
        if (is_null($dataSchedule)){
            $dataSchedule = Schedule::query()->create([
                'tanggal' => $dateNow,
            ]);
        }

        $this->shiftSelected = $dataSchedule;

        return $dataSchedule;
    }

    public function render()
    {
        $this->checkShift();


        $items = Item::all();
        return view('livewire.checking', compact('items'));
    }
}
