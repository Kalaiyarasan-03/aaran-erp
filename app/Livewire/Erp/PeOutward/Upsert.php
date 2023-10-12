<?php

namespace App\Livewire\Erp\PeOutward;

use App\Livewire\Controls\Items\Common\ColourItem;
use App\Livewire\Controls\Items\Common\SizeItem;
use App\Models\Erp\PeOutward;
use App\Models\Erp\PeOutwardItem;
use App\Models\Master\Contact;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use DB;
use Livewire\Component;

class Upsert extends Component
{

    public string $contact_name = '';
    public string $contact_id;
    public string $vno;
    public string $vdate;
    public string $jobcard_id;
    public string $jobcard_no;
    public mixed $total_qty;

    public string $searches = '';
    public string $id = '';
//    public Collection $list;
    public int $selectHighlight = 0;


    public array $list = [
        [
            'fabric_lot_name' => '102',
            'colour_name' => 'Red',
            'size_name' => 'M',
            'qty' => '20',
        ],
        [
            'fabric_lot_name' => '102',
            'colour_name' => 'Red',
            'size_name' => 'M',
            'qty' => '20',
        ],
        [
            'fabric_lot_name' => '102',
            'colour_name' => 'Red',
            'size_name' => 'M',
            'qty' => '20',
        ],
        [
            'fabric_lot_name' => '102',
            'colour_name' => 'Red',
            'size_name' => 'M',
            'qty' => '20',
        ]
    ];

    public function setObj($name, $id): void
    {
        $this->id = $id;
        $this->searches = $name;
        $this->getList();
        $this->dispatchObj();
    }

    public function selectObj(): void
    {
        $obj = $this->list[$this->selectHighlight] ?? null;
        $this->resetEmpty();
        $this->searches = $obj['vname'] ?? '';;
        $this->id = $obj['id'] ?? '';;
        $this->dispatchObj();
    }

    public function resetEmpty(): void
    {
        $this->searches = '';
        $this->list = Collection::empty();
        $this->selectHighlight = 0;
    }

    public function incrementHighlight(): void
    {
        if ($this->selectHighlight === count($this->list) - 1) {
            $this->selectHighlight = 0;
            return;
        }
        $this->selectHighlight++;
    }

    public function decrementHighlight(): void
    {
        if ($this->selectHighlight === 0) {
            $this->selectHighlight = count($this->list) - 1;
            return;
        }
        $this->selectHighlight--;
    }

    #[On('refresh-contact-item')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->searches = $v['name'];
        $this->getList();
    }

    public function dispatchObj(): void
    {
        $this->dispatch('refresh-contact',['id'=>$this->id,'name'=>$this->searches]);
    }

    public function getList(): void
    {
        $this->list = $this->searches ? Contact::search(trim($this->searches))
            ->get() : Contact::all();
    }

    public function render()
    {
        return view('livewire.erp.pe-outward.upsert');
    }
}
