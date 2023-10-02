<?php

namespace App\Livewire\Erp\PeInward;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\PeInward;

class Index extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('peinwards.upsert', ['0']));
    }

    public function getList()
    {
        return PeInward::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.erp.pe-inward.index')->with([
            'list' => $this->getList()
        ]);
    }
}
