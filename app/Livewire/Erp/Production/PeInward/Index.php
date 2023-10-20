<?php

namespace App\Livewire\Erp\Production\PeInward;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\Production\PeInward;

class Index  extends EntriesIndexAbstract
{
    public function create(): void
    {
        $this->redirect(route('peinwards.upsert', ['0']));
    }

    public function getList()
    {
        return PeInward::search($this->searches)
            ->select('orders.vname as order_name',
                'styles.vname as style_name',
                'jobcards.vno as jobcard_no',
                'contacts.vname as contact_name',
                'pe_outwards.total_qty as total_qty',
                'pe_inwards.*'
            )
            ->join('contacts', 'contacts.id', '=', 'pe_inwards.contact_id')
            ->join('jobcards', 'jobcards.id', '=', 'pe_inwards.jobcard_id')
            ->join('orders', 'orders.id', '=', 'jobcards.order_id')
            ->join('styles', 'styles.id', '=', 'jobcards.style_id')
            ->where('pe_inwards.active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.erp.production.pe-inward.index')->with([
            'list' => $this->getList()
        ]);
    }
}
