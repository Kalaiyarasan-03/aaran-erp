<?php

namespace App\Livewire\Admin\Creditbook;

use App\Livewire\Trait\CommonTrait;
use App\Models\Admin\CreditBook;
use App\Models\Master\ClientBank;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $closing = '';

    public function getSave(): string
    {

        if ($this->vname !== '') {
            if ($this->vid == "") {
                CreditBook::create([
                    'vname' => \Str::upper($this->vname),
                    'closing' => $this->closing,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $message = "Saved";

            } else {
                $obj = CreditBook::find($this->vid);
                $obj->vname = \Str::upper($this->vname);
                $obj->closing = $this->closing;
                $obj->active_id = $this->active_id;
                $obj->user_id = \Auth::id();
                $obj->save();
                $message = "Updated";
            }
            $this->closing = '';
            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = ClientBank::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->closing = $obj->closing;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'id';

        return CreditBook::search($this->searches)
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
        return view('livewire.admin.creditbook.index')->with([
            'list' => $this->getList()
        ]);
    }
}
