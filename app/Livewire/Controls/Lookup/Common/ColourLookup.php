<?php

namespace App\Livewire\Controls\Lookup\Common;

use App\Models\Common\Colour;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ColourLookup extends Component
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
        $obj = $v ? Colour::find($v) : '';
        if ($obj) {
            $this->searches = $obj->vname;
        }
    }
    #[On('update-colour')]
    public function setColour($name, $ids)
    {
        $this->searches = $name;
        $this->dispatch('set-colour', $ids);
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
        $this->dispatch('set-colour', $obj['id'] ?? '');
    }

    public function resetData()
    {
        $this->searches = '';
        $this->list = Colour::empty();
        $this->highlightIndex = 0;
    }


    public function render()
    {
        $this->list = $this->searches ? Colour::search(trim($this->searches))
            ->get() : Colour::all();
        return view('livewire.controls.lookup.common.colour-lookup');
    }
}
