<?php

namespace App\Livewire\Controls\Items\Common;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Common\Size;
use Livewire\Attributes\On;

class SizeItem  extends ItemLookupAbstract
{
    #[On('refresh-size-item')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->searches = $v['name'];
        $this->getList();
    }

    public function dispatchObj(): void
    {
        $this->dispatch('refresh-size',['id'=>$this->id,'name'=>$this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? Size::search(trim($this->searches))
            ->get() : Size::all();
    }

    public function render()
    {
        $this->getList();
        return view('livewire.controls.items.common.size-item');
    }
}
