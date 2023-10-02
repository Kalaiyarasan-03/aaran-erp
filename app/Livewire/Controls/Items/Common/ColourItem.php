<?php

namespace App\Livewire\Controls\Items\Common;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Common\Colour;
use Livewire\Attributes\On;

class ColourItem extends ItemLookupAbstract
{
    #[On('refresh-colour-item')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->searches = $v['name'];
        $this->getList();
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
