<?php

namespace App\Livewire\Erp\Production\PeInward;

use App\Models\Erp\PeOutward;
use Livewire\Component;

class Index extends Component
{
    public function create(): void
    {
        $this->redirect(route('peoutwards.upsert',['0']));
    }

    public function getList()
    {
        return PeOutward::search($this->searches)
            ->select('orders.vname as order_name',
                'styles.vname as style_name',
                'contacts.vname as contact_name',
                'pe_outwards.total_qty as total_qty',
                'pe_outwards.*'

            )
            ->join('contacts', 'contacts.id', '=', 'pe_outwards.contact_id')
            ->join('jobcards', 'jobcards.id', '=', 'pe_outwards.jobcard_id')
            ->join('orders', 'orders.id', '=', 'jobcards.order_id')
            ->join('styles', 'styles.id', '=', 'jobcards.style_id')
            ->where('pe_outwards.active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.erp.production.pe-inward.index');
    }
}
