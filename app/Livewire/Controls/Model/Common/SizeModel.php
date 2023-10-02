<?php

namespace App\Livewire\Controls\Model\Common;

use App\Models\Common\Size;
use Livewire\Component;

class SizeModel extends Component
{
    public bool $showModel = false;

    public string $vname = "";

    public function mount($name)
    {
        $this->vname = $name;
    }

    public function save()
    {
        if ($this->vname != '') {
            $obj = Size::create([
                'vname' => \Str::upper($this->vname),
                'active_id' => '1'
            ]);
            $this->dispatch('update-size', $this->vname, $obj->id);
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
        return view('livewire.controls.model.common.size-model');
    }
}
