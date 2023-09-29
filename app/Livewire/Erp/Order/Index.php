<?php

namespace App\Livewire\Erp\Order;

use App\Livewire\Trait\CommonTrait;
use App\Models\Erp\Order;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $desc = '';

    public function getSave(): string
    {
        if ($this->vname != '') {

            if ($this->vid == "") {
                Order::create([
                    'vname' => \Str::upper($this->vname),
                    'desc' => \Str::ucfirst($this->desc),
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $message = "Saved";

            } else {
                $obj = Order::find($this->vid);
                $obj->vname = \Str::upper($this->vname);
                $obj->desc = \Str::ucfirst($this->desc);
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();
                $message = "Updated";
            }

            $this->desc = '';
            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Order::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->desc = $obj->desc;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'id';

        return Order::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.erp.order.index')->with([
            'list' => $this->getList()
        ]);
    }
}
