<?php

namespace App\Livewire;

use App\Models\Item;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Component;

class ItemsView extends Component
{
    public $currentUrl = '/items-database';

    public $searchInput;

    public function save(Request $request)
    {
        $part_name = $request->get('partName');
        if ($request->method() == 'POST'){
            if (!is_null($part_name)){
                Item::query()->create([
                    'part_name' => $request->get('partName')
                ]);
                session()->flash('create-item-success');
            }
            else{
                session()->flash('partNameInputNull');
            }
            return redirect('/items-database');
        }
    }

    public function render()
    {
        $items = Item::query();

        if (!is_null($this->searchInput)){
            $items->where('part_name', 'LIKE', '%'.$this->searchInput.'%');
        }

        $items = $items->paginate('10');
        return view('livewire.items-view', compact('items'));
    }
}
