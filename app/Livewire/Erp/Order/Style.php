<?php

namespace App\Livewire\Erp\Order;

use App\Livewire\Trait\EntriesIndexAbstract;
use App\Models\Erp\Order;
use App\Models\Erp\Production\Jobcard;

class Style extends EntriesIndexAbstract
{

    public $vid;
    public Order $order;

    public function mount($id)
    {
        $this->vid = $id;
        $this->order = Order::find($id);
    }


    public function render()
    {
        return view('livewire.erp.order.style')->with([
            'list' => Jobcard::search($this->searches)
                ->select('orders.vname as order_name',
                    'styles.vname as style_name',
                    'jobcards.*'
                )
                ->join('orders', 'orders.id', '=', 'jobcards.order_id')
                ->join('styles', 'styles.id', '=', 'jobcards.style_id')
                ->where('jobcards.order_id', '=', $this->vid)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
