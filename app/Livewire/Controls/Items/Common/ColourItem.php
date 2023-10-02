<?php

namespace App\Livewire\Controls\Items\Common;

use App\Models\Common\Colour;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ColourItem extends Component
{
    public string $colour_name='';
    public string $colour_id='';
    public Collection $colours;
    public $colourHighlight = 0;

    #[On('update-colour')]
    public function updateColour($v): void
    {
        $this->colour_id = $v['id'];
        $this->colour_name = $v['name'];
        $this->getColourList();
    }

    public function setColour($name,$id): void
    {
        $this->colour_id = $id;
        $this->colour_name = $name;
        $this->getColourList();
    }
    public function getColourList(): void
    {
        $this->colours = $this->colour_name ? Colour::search(trim($this->colour_name))
            ->get() : Colour::all();
    }
    public function selectColours(): void
    {
        $obj = $this->colours[$this->colourHighlight] ?? null;
        $this->colourEmpty();
        $this->colour_name = $obj['vname'] ?? '';;
        $this->colour_id = $obj['id'] ?? '';;
    }

    public function colourEmpty(): void
    {
        $this->colour_name = '';
        $this->colours = Collection::empty();
        $this->colourHighlight = 0;
    }

    public function incrementColour(): void
    {
        if ($this->colourHighlight === count($this->colours) - 1) {
            $this->colourHighlight = 0;
            return;
        }
        $this->colourHighlight++;
    }

    public function decrementColour(): void
    {
        if ($this->colourHighlight === 0) {
            $this->colourHighlight = count($this->colours) - 1;
            return;
        }
        $this->colourHighlight--;
    }
    public function render()
    {
        $this->getColourList();
        return view('livewire.controls.items.common.colour-item');
    }
}
