<?php

namespace App\Livewire\Controls\Model\Erp;

use App\Models\Erp\Order;
use Livewire\Component;

class OrderModel extends Component
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
            $obj = Order::create([
                'vname' => $this->vname,
                'desc' => $this->desc,
                'active_id' => '1',
                'user_id' => \Auth::id()
            ]);
            $this->dispatch('refresh-order-item', ['name' => $this->vname, 'id' => $obj->id]);
            $this->dispatch('refresh-order', ['name' => $this->vname, 'id' => $obj->id]);
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
        return view('livewire.controls.model.erp.order-model');
    }
}
