<?php

namespace App\Livewire\Controls\Lookup\Erp;

use App\Models\Erp\Order;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderLookup extends Component
{
    public string $searches = "";
    public int $highlightIndex = 0;

    public Collection $list;
    public $class;

    public function mount($v = null, $class = null)
    {
        if ($class) {
            $this->class = $class;
        }
        $obj = $v ? Order::find($v) : '';
        if ($obj) {
            $this->searches = $obj->vname;
        }
    }
    #[On('update-order')]
    public function setOrder($name, $ids)
    {
        $this->searches = $name;
        $this->dispatch('set-order', $ids);
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->list) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->list) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectHighlight()
    {
        $obj = $this->list[$this->highlightIndex] ?? null;
        $this->resetData();
        $this->searches = $obj['vname'] ?? '';
        $this->dispatch('set-order', $obj['id'] ?? '');
    }

    public function resetData()
    {
        $this->searches = '';
        $this->list = Collection::empty();
        $this->highlightIndex = 0;
    }


    public function render()
    {
        $this->list = $this->searches ? Order::search(trim($this->searches))
            ->get() : Order::all();

        return view('livewire.controls.lookup.erp.order-lookup');
    }
}
