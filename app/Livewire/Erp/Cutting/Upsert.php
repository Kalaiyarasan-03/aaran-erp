<?php

namespace App\Livewire\Erp\Cutting;

use App\Livewire\Trait\CommonTrait;
use App\Models\Erp\Cutting;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTrait;

    public Cutting $cutting;
     public mixed $order_id;
    public mixed $cutting_date;
    public mixed $cutting_master;
    public mixed $cutting_qty;

    public function mount($id)
    {
        $this->cutting = Cutting::find($id);
    }







    public function getSave(): string
    {
        if ($this->order_id != '') {

            if ($this->vid == "") {
                Cutting::create([
                    'order_id' => $this->order_id,
                    'cutting_date' => $this->cutting_date,
                    'cutting_master' => $this->cutting_master,
                    'cutting_qty' => $this->cutting_qty,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $message = "Saved";

            } else {
                $obj = Cutting::find($this->vid);
                $obj->order_id = $this->order_id;
                $obj->cutting_date = $this->cutting_date;
                $obj->cutting_master = $this->cutting_master;
                $obj->cutting_qty = $this->cutting_qty;
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();
                $message = "Updated";
            }
            $this->cutting_date = '';
            $this->cutting_master = '';
            $this->cutting_qty = '';
            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Cutting::find($id);
            $this->vid = $obj->id;
            $this->order_id = $obj->order_id;
            $this->cutting_date = $obj->cutting_date;
            $this->cutting_master = $obj->cutting_master;
            $this->cutting_qty = $obj->cutting_qty;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'id';

        return Cutting::search($this->searches)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.erp.cutting.upsert')->with([
            'list' => $this->getList()
        ]);
    }
}
