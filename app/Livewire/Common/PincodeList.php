<?php

namespace App\Livewire\Common;

use App\Livewire\Trait\CommonTrait;
use App\Models\Common\Pincode;
use Illuminate\Support\Str;
use Livewire\Component;

class PincodeList extends Component
{
    use CommonTrait;

   public function getSave(): string
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                Pincode::create([
                    'vname' => Str::upper($this->vname),
                    'active_id' => $this->active_id,
                ]);
                $message = "Saved";

            } else {
                $obj = Pincode::find($this->vid);
                $obj->vname = Str::upper($this->vname);
                $obj->active_id = $this->active_id;
                $obj->save();
                $message = "Updated";
            }
            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Pincode::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        return Pincode::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render()->render();
    }

   public function render()
    {
        return view('livewire.common.pincode-list')->with([
             'list' => $this->getList()
        ]);
    }
}
