<?php

namespace App\Livewire\Erp\PeOutward;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\PeOutward;

class Index extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('peoutwards.upsert',['0']));
    }

    public function getList()
    {
        return PeOutward::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    public function render()
    {
        return view('livewire.erp.pe-outward.index')->with([
            'list' => $this->getList()
        ]);
    }
}
