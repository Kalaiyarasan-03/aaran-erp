<?php

namespace App\Livewire\Erp\Cutting;

use App\Livewire\Trait\CommonTrait;
use App\Models\Erp\Cutting;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $order_id = '';
    public string $cutting_date = '';
    public string $cutting_master = '';
    public string $cutting_qty = '';

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
        return view('livewire.erp.cutting.index')->with([
            'list' => $this->getList()
        ]);
    }
}