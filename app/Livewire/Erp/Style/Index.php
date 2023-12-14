<?php

namespace App\Livewire\Erp\Style;

use App\Livewire\Trait\CommonTrait;
use App\Models\Erp\Order;
use App\Models\Erp\Style;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $desc = '';

    public function getSave(): string
    {
        if (session()->has('tenant_id')) {

            if ($this->vname != '') {

                if ($this->vid == "") {
                    Style::create([
                        'vname' => Str::upper($this->vname),
                        'desc' => Str::ucfirst($this->desc),
                        'active_id' => $this->active_id,
                        'user_id' => Auth::id(),
                    ]);
                    $message = "Saved";

                } else {
                    $obj = Style::find($this->vid);
                    $obj->vname = Str::upper($this->vname);
                    $obj->desc = Str::ucfirst($this->desc);
                    $obj->active_id = $this->active_id ?: '0';
                    $obj->user_id = Auth::id();
                    $obj->save();
                    $message = "Updated";
                }

                $this->desc = '';
                return $message;
            }
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Style::find($id);
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

        return Style::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->where('tenant_id', '=', session()->get('tenant_id'))
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.erp.style.index')->with([
            'list' => $this->getList()
        ]);
    }
}
