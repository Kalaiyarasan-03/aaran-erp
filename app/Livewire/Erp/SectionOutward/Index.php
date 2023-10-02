<?php

namespace App\Livewire\Erp\SectionOutward;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\SectionOutward;

class Index extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('sectionoutwards.upsert',['0']));
    }

    public function getList()
    {
        return SectionOutward::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    public function render()
    {
        return view('livewire.erp.section-outward.index')->with([
            'list' => $this->getList()
        ]);
    }
}
