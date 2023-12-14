<?php

namespace App\Livewire\Controls\Model\Erp;

use App\Models\Erp\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
                'vname' => Str::upper($this->vname),
                'desc' => Str::ucfirst($this->desc),
                'active_id' => '1',
                'tenant_id' => session()->get('tenant_id'),
                'user_id' => Auth::id()
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
