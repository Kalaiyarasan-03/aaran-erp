<?php

namespace App\Livewire\Erp\Production\Cutting;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\Production\Cutting;

class Index  extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('cuttings.upsert',['0']));
    }

    public function getList()
    {
        return Cutting::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.erp.production.cutting.index')->with([
            'list' => $this->getList()
        ]);
    }
}
