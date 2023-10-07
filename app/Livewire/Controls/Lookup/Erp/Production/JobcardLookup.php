<?php

namespace App\Livewire\Controls\Lookup\Erp\Production;

use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Erp\Jobcard;
use Livewire\Attributes\On;

class JobcardLookup  extends ItemLookupAbstract
{
    #[On('refresh-jobcard-item')]
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
        $this->dispatch('refresh-jobcard',['id'=>$this->id,'name'=>$this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? Jobcard::search(trim($this->searches))
            ->get() : Jobcard::all();
    }

    public function render()
    {
        return view('livewire.controls.lookup.erp.production.jobcard-lookup');
    }
}
