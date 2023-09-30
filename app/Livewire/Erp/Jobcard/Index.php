<?php

namespace App\Livewire\Erp\Jobcard;

use App\Livewire\Trait\CommonTrait;
use App\Models\Erp\Jobcard;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $order_id = '';
    public string $total_qty = '';

    public function getSave(): string
    {
        if ($this->order_id != '') {

            if ($this->vid == "") {
                Jobcard::create([
                    'order_id' => $this->order_id,
                    'total_qty' => $this->total_qty,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $message = "Saved";

            } else {
                $obj = Jobcard::find($this->vid);
                $obj->order_id = $this->order_id;
                $obj->total_qty = $this->total_qty;
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
            $obj = Jobcard::find($id);
            $this->vid = $obj->id;
            $this->order_id = $obj->order_id;
            $this->total_qty = $obj->total_qty;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'id';

        return Jobcard::search($this->searches)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.erp.jobcard.index')->with([
            'list' => $this->getList()
        ]);
    }
}
