<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $order_id = '';

    #[On('set-order')]
    public function updateOrder($id)
    {
        $this->order_id = $id;
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
