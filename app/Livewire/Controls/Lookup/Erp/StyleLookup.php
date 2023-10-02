<?php

namespace App\Livewire\Controls\Lookup\Erp;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Erp\Style;
use Livewire\Attributes\On;

class StyleLookup extends ItemLookupAbstract
{
    #[On('refresh-style-item')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->searches = $v['name'];
        $this->getList();
    }
    public function mount($id,$name)
    {
        $this->id = $id;
        $this->searches = $name;
        $this->getList();
    }
    public function dispatchObj(): void
    {
        $this->dispatch('refresh-style', ['id' => $this->id, 'name' => $this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? Style::search(trim($this->searches))
            ->get() : Style::all();
    }

    public function render()
    {
        $this->getList();
        return view('livewire.controls.lookup.erp.style-lookup');
    }
}
