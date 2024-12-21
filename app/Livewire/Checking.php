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

    public Schedule $shiftSelected;

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
        $userId = auth()->user()->id;
        if (is_null($this->shiftChoice)){
            session()->flash('belum-pilih-shift');
            $this->redirect('/checking', true);
            return;
        }

        if ($this->shiftChoice == 'shift1'){
            $this->shiftSelected->update([
                'shift1_id' => $userId
            ]);
            session()->flash('success-masuk-session', 'Anda telah masuk shift 1');
        }

        if ($this->shiftChoice == 'shift2'){
            $this->shiftSelected->update([
                'shift2_id' => $userId
            ]);
            session()->flash('success-masuk-session', 'Anda telah masuk shift 2');
        }
        $this->shiftSelected->save();
        $this->redirect('/checking', true);
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
