<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\RemarkNG;
use App\Models\Schedule;
use Livewire\Component;

class Checking extends Component
{
    public $currentUrl = '/checking';
    public $addPartNoBefore = 0;
    public $ngChoice;

    public $shiftChoice;
    public $addPartNoInput;

    public Schedule $shiftSelected;
    public $itemSelected;
    public \App\Models\Checking $checkQaSelected;

    public function checkItemSelected($id)
    {
        if (!is_null($id)){
            $this->itemSelected = Item::query()->find($id);
        }
    }

    public function checkSelected($id)
    {
        if (!is_null($id)){
            $this->checkQaSelected = \App\Models\Checking::query()->find($id);
        }
    }

    public function ngChoiceFun()
    {
        $this->ngChoice = true;
    }

    public function backButton()
    {
        $this->ngChoice = null;
    }

    public function saveOkConfirmation()
    {
        if (!in_array(auth()->user()->id, [$this->shiftSelected->shift1_id, $this->shiftSelected->shift2_id])){
            session()->flash('belum-masuk-shift', 'Anda belum masuk shift');
            $this->redirect('/checking');
            return;
        }
        $this->checkQaSelected->update([
            'OK' => $this->checkQaSelected->OK + 1,
            'total' => $this->checkQaSelected->total + 1
        ]);
        session()->flash('checking-success');
        $this->redirect('/checking');
    }

    public function saveNGConfirmation($type)
    {
        if (!in_array(auth()->user()->id, [$this->shiftSelected->shift1_id, $this->shiftSelected->shift2_id])){
            session()->flash('belum-masuk-shift', 'Anda belum masuk shift');
            $this->redirect('/checking');
            return;
        }
        $this->checkQaSelected->update([
            'NG' => $this->checkQaSelected->NG + 1,
            'total' => $this->checkQaSelected->total + 1
        ]);

        if ($type == 'SILVER'){
            $this->checkQaSelected->remarkNG()->update([
                'SLVR' => $this->checkQaSelected->remarkNG->SLVR + 1
            ]);
        }

        if ($type == 'BURRY'){
            $this->checkQaSelected->remarkNG()->update([
                'BRY' => $this->checkQaSelected->remarkNG->BRY + 1
            ]);
        }

        if ($type == 'GLOSS'){
            $this->checkQaSelected->remarkNG()->update([
                'GLS' => $this->checkQaSelected->remarkNG->GLS + 1
            ]);
        }

        if ($type == 'FLOW BLACK'){
            $this->checkQaSelected->remarkNG()->update([
                'FWBK' => $this->checkQaSelected->remarkNG->FWBK + 1
            ]);
        }

        if ($type == 'BENANG RUNNER'){
            $this->checkQaSelected->remarkNG()->update([
                'BNG_RNR' => $this->checkQaSelected->remarkNG->BNG_RNR + 1
            ]);
        }

        if ($type == 'SINMARK'){
            $this->checkQaSelected->remarkNG()->update([
                'SNMRK' => $this->checkQaSelected->remarkNG->SNMRK + 1
            ]);
        }

        if ($type == 'STARTCH'){
            $this->checkQaSelected->remarkNG()->update([
                'STRATCH' => $this->checkQaSelected->remarkNG->STRATCH + 1
            ]);
        }

        if ($type == 'SHOT MOLD'){
            $this->checkQaSelected->remarkNG()->update([
                'SHOT_MOLD' => $this->checkQaSelected->remarkNG->SHOT_MOLD + 1
            ]);
        }

        session()->flash('checking-success');
        $this->redirect('/checking');
    }

    // For Add New Part No
    public function addPartNo()
    {
        if (is_null($this->itemSelected)){
            session()->flash('belum-memilih-item', 'Anda memilih item');
            $this->redirect('/checking');
            return;
        }

        if (!in_array(auth()->user()->id, [$this->shiftSelected->shift1_id, $this->shiftSelected->shift2_id])){
            session()->flash('belum-masuk-shift', 'Anda belum masuk shift');
            $this->redirect('/checking');
            return;
        }

        if (is_null($this->addPartNoInput)){
            session()->flash('part-no-kosong', 'Part No Tidak Boleh Kosong');
            $this->redirect('/checking');
            return;
        }

        // Create Checking Item with no part
        $checking = \App\Models\Checking::query()->create([
            'item_id' => $this->itemSelected->id,
            'schedule_id' => $this->shiftSelected->id,
            'part_no' => $this->addPartNoInput,
        ]);

        // Create Remark NG for item
        RemarkNG::query()->create([
            'checking_id' => $checking->id,
        ]);

        session()->flash('success-add-part-no', $this->itemSelected->id);
        $this->redirect('/checking');
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
        if (session()->has('success-add-part-no')){
            $idItem = session()->get('success-add-part-no');
            $this->checkItemSelected($idItem);
            $this->addPartNoBefore = 1;
        }

        $this->checkShift();
        $items = Item::all();
        $checkings = [];
        if (!is_null($this->itemSelected)){
            $checkings = \App\Models\Checking::query()
                ->where('item_id', '=', $this->itemSelected->id)
                ->where('schedule_id', '=', $this->shiftSelected->id)
                ->get();
        }
        return view('livewire.checking', compact('items', 'checkings'));
    }
}
