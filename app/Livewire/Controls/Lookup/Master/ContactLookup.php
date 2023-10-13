<?php

namespace App\Livewire\Controls\Lookup\Master;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Erp\Order;
use App\Models\Master\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactLookup extends ItemLookupAbstract
{

    public bool $Typed = false;
    #[On('refresh-contact-item')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->searches = $v['name'];
        $this->getList();
    }

    public function mount($id,$name)
    {
        $this->id = $id;
        $this->searches = $name;
        $this->getList();
    }

    public function dispatchObj(): void
    {
        $this->Typed = false;
        $this->dispatch('refresh-contact',['id'=>$this->id,'name'=>$this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? Contact::search(trim($this->searches))
            ->get() : Contact::all();
    }

    public function render()
    {
        $this->getList();
        return view('livewire.controls.lookup.master.contact-lookup');
    }
}
