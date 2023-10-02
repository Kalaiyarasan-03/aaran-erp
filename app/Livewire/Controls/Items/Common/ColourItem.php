<?php

namespace App\Livewire\Controls\Items\Common;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Common\Colour;
use Livewire\Attributes\On;

class ColourItem extends ItemLookupAbstract
{

    public mixed $class;
    public  mixed $label;

    public function mount($class = null, $label = null)
    {
        if ($label) {
            $this->label = $label;
        }

        if ($class) {
            $this->class = $class;
        }
    }

    #[On('refresh-colour')]
    public function refreshObj($v): void
    {
    }

    public function dispatchObj(): void
    {
        $this->dispatch('refresh-colour',['id'=>$this->id,'name'=>$this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? Colour::search(trim($this->searches))
            ->get() : Colour::all();
    }

    public function render()
    {
        $this->getList();
        return view('livewire.controls.items.common.colour-item');
    }
}
