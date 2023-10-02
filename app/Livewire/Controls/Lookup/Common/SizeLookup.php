<?php

namespace App\Livewire\Controls\Lookup\Common;

use App\Models\Common\Size;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class SizeLookup extends Component
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
        $obj = $v ? Size::find($v) : '';
        if ($obj) {
            $this->searches = $obj->vname;
        }
    }
    #[On('update-size')]
    public function setSize($name, $ids)
    {
        $this->searches = $name;
        $this->dispatch('set-size', $ids);
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
        $this->dispatch('set-size', $obj['id'] ?? '');
    }

    public function resetData()
    {
        $this->searches = '';
        $this->list = Size::empty();
        $this->highlightIndex = 0;
    }


    public function render()
    {
        $this->list = $this->searches ? Size::search(trim($this->searches))
            ->get() : Size::all();
        return view('livewire.controls.lookup.common.size-lookup');
    }
}
