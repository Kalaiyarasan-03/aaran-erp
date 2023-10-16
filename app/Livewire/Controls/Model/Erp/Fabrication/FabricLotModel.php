<?php

namespace App\Livewire\Controls\Model\Erp\Fabrication;

use App\Models\Erp\Production\FabricLot;
use Livewire\Component;

class FabricLotModel extends Component
{
    public bool $showModel = false;

    public string $vname = "";
    public string $desc = "";

    public function mount($name)
    {
        $this->vname = $name;
    }

    public function save()
    {
        if ($this->vname != '') {
            $obj = FabricLot::create([
                'vname' => \Str::ucfirst($this->vname),
                'desc' => \Str::ucfirst($this->desc),
                'active_id' => '1',
                'user_id' => \Auth::id()
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
        $this->desc = "";
    }

    public function render()
    {
        return view('livewire.controls.model.erp.fabrication.fabric-lot-model');
    }
}
