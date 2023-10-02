<?php

namespace App\Livewire\Erp\SectionInward;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\SectionInward;

class Index extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('sectioninwards.upsert',['0']));
    }

    public function getList()
    {
        return SectionInward::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    public function render()
    {
        return view('livewire.erp.section-inward.index')->with([
            'list' => $this->getList()
        ]);
    }
}
