<?php

namespace App\Livewire\Controls\Model\Erp\Orders;

use App\Models\Erp\Production\FabricLot;
use Livewire\Component;

class FabricLotModel extends Component
{
    public bool $showModel = false;

    public string $vname = "";

    public function mount($name)
    {
        $this->vname = $name;
    }

    public function save()
    {
        if ($this->vname != '') {
            $obj = FabricLot::create([
                'vname' => \Str::ucfirst($this->vname),
                'active_id' => '1'
            ]);
            $this->dispatch('refresh-fabric-lot-item', ['name' => $this->vname, 'id' => $obj->id]);
            $this->dispatch('refresh-fabric-lot', ['name' => $this->vname, 'id' => $obj->id]);
            $this->clearAll();
        }
    }

    public function clearAll()
    {
        $this->showModel = false;
        $this->vname = "";
    }

    public function render()
    {
        return view('livewire.controls.model.erp.orders.fabric-lot-model');
    }
}
