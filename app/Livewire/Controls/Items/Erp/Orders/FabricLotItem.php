<?php

namespace App\Livewire\Controls\Items\Erp\Orders;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Erp\Production\FabricLot;
use Livewire\Attributes\On;

class FabricLotItem extends ItemLookupAbstract
{
    #[On('refresh-fabric-lot-item')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->searches = $v['name'];
        $this->getList();
    }

    public function dispatchObj(): void
    {
        $this->dispatch('refresh-fabric-lot',['id'=>$this->id,'name'=>$this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? FabricLot::search(trim($this->searches))
            ->get() : FabricLot::all();
    }

    public function render()
    {
        $this->getList();
        return view('livewire.controls.items.erp.orders.fabric-lot-item');
    }
}
