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

    public Collection $contacts;
    public int $selectHighlight = 0;
    public bool $showDropdown = false;



//    public $list;

    public function setObj($name, $id): void
    {
        $this->contact_name = $name;
        $this->contact_id = $id;
        $this->getList();
    }

    public function selectObj(): void
    {
        $obj = $this->contacts[$this->selectHighlight] ?? null;
        $this->resetEmpty();
        $this->contact_name = $obj['vname'] ?? '';;
        $this->contact_id = $obj['id'] ?? '';;
    }

    public function resetEmpty(): void
    {
        $this->contact_name = '';
        $this->contacts = Collection::empty();
        $this->selectHighlight = 0;
    }

    public function incrementHighlight(): void
    {
        if ($this->selectHighlight === count($this->contacts) - 1) {
            $this->selectHighlight = 0;
            return;
        }
        $this->selectHighlight++;
    }

    public function decrementHighlight(): void
    {
        if ($this->selectHighlight === 0) {
            $this->selectHighlight = count($this->contacts) - 1;
            return;
        }
        $this->selectHighlight--;
    }

    public function getList(): void
    {
        $this->contacts = $this->contact_name ? Contact::search(trim($this->contact_name))
            ->get() : Contact::all();
    }

    #[On('refresh-contact')]
    public function refreshContact($v): void
    {
        $this->contact_id = $v['id'];
        $this->contact_name = $v['name'];
        $this->showDropdown = false;

    }

    public function render()
    {
        $this->getList();
        return view('livewire.erp.pe-outward.upsert');
    }
}
