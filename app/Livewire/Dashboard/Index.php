<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $order_id = '';

    #[On('set-order')]
    public function updateOrder($id): void
    {
        $this->order_id = $id;
    }
    #[On('refresh-render')]
    public function reRender()
    {
        $this->render()->render();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
