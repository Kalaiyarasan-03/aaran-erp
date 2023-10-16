<?php

namespace App\Livewire\Erp\Production\Jobcard;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\Production\Jobcard;

class Index  extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('jobcards.upsert', ['0']));
    }

    public function getList()
    {
        return Jobcard::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.erp.production.jobcard.index')->with([
            'list' => $this->getList()
        ]);
    }
}
