<?php

namespace App\Livewire\Controls\Model\Common;

use App\Models\Common\Colour;
use Livewire\Component;

class ColourModel extends Component
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
            $obj = Colour::create([
                'vname' => \Str::ucfirst($this->vname),
                'active_id' => '1'
            ]);
            $this->dispatch('update-colour', ['name' => $this->vname, 'id' => $obj->id]);
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
        return view('livewire.controls.model.common.colour-model');
    }
}
