<?php

namespace App\Livewire;

use App\Models\Schedule;
use Livewire\Component;

class LaporanQA extends Component
{
    public $currentUrl = '/laporan-qa';

    public $dateFilter;

    public $scheduleData;
    public $checkingsData;

    private function getDayReport($dateIn = null)
    {
        if (is_null($dateIn)){
            $dateNow = date('Y-m-d');
            $this->dateFilter = $dateNow;
        }else{
            $dateNow = $dateIn;
        }

        $getSchedule = Schedule::query()->whereDate('tanggal', '=', $dateNow)->first();
        if (is_null($getSchedule)){
            $this->checkingsData = null;
            $this->scheduleData = null;
            $this->totalCount = 0;
            $this->okCount = 0;
            $this->ngCount = 0;
            $this->okPercent = 0;
            $this->ngPercent = 0;
            return;
        }

        $scheduleId = $getSchedule->id;
        $this->checkingsData = \App\Models\Checking::query()->where('schedule_id', '=', $scheduleId)->get();
        $this->scheduleData = $getSchedule;
    }

    public function filter()
    {
        $this->getDayReport($this->dateFilter);
    }

    public function mount()
    {
        $this->getDayReport();
    }

    // Resume Data Variable
    public $totalCount;
    public $okCount;
    public $ngCount;
    public $okPercent;
    public $ngPercent;

    public function render()
    {
        if (!is_null($this->checkingsData)){
            $totalCount = 0;
            $okCount = 0;
            $ngCount = 0;

            foreach ($this->checkingsData as $data){
                $totalCount += $data->total;
                $okCount += $data->OK;
                $ngCount += $data->NG;
            }

            $OKpercent = ($okCount / $totalCount) * 100;
            $NGpercent = ($ngCount / $totalCount) * 100;

            $this->totalCount = $totalCount;
            $this->okCount = $okCount;
            $this->ngCount = $ngCount;
            $this->okPercent = $OKpercent;
            $this->ngPercent = $NGpercent;

        }
        return view('livewire.laporan-q-a');
    }
}
