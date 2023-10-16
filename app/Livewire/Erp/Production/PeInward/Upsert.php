<?php

namespace App\Livewire\Erp\Production\PeInward;

use App\Models\Erp\Jobcard;
use App\Models\Erp\PeInward;
use App\Models\Erp\PeInwardItem;
use App\Models\Erp\PeOutward;
use App\Models\Erp\PeOutwardItem;
use App\Models\Master\Contact;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Upsert extends Component
{
    public Collection $contactCollection;
    public Collection $jobcardCollection;
    public Collection $peOutwardCollection;

    public string $contact_name = '';
    public string $contact_id = '';
    public string $jobcard_id = '';
    public string $jobcard_no = '';

    public string $pe_outward_id = '';
    public string $pe_outward_no = '';
    public string $style_name = '';

    public int $highlightContact = 0;
    public int $highlightJobcard = 0;
    public int $highlightPeOutward = 0;

    public bool $contactTyped = false;
    public bool $jobcardTyped = false;
    public bool $peOutwardTyped = false;


    public string $vno = '';
    public string $vdate = '';

    public mixed $total_qty = 0;
    public mixed $receiver_details = '';
    public string $active_id = '1';

    public function setContact($name, $id): void
    {
        $this->contact_name = $name;
        $this->contact_id = $id;
        $this->getContactList();
    }

    public function enterContact(): void
    {
        $obj = $this->contactCollection[$this->highlightContact] ?? null;

        $this->contact_name = '';
        $this->contactCollection = Collection::empty();
        $this->highlightContact = 0;

        $this->contact_name = $obj['vname'] ?? '';;
        $this->contact_id = $obj['id'] ?? '';;
    }

    public function incrementContact(): void
    {
        if ($this->highlightContact === count($this->contactCollection) - 1) {
            $this->highlightContact = 0;
            return;
        }
        $this->highlightContact++;
    }

    public function decrementContact(): void
    {
        if ($this->highlightContact === 0) {
            $this->highlightContact = count($this->contactCollection) - 1;
            return;
        }
        $this->highlightContact--;
    }

    public function getContactList(): void
    {
        $this->contactCollection = $this->contact_name ? Contact::search(trim($this->contact_name))
            ->get() : Contact::all();
    }

    #[On('refresh-contact')]
    public function refreshContact($v): void
    {
        $this->contact_id = $v['id'];
        $this->contact_name = $v['name'];
        $this->contactTyped = false;

    }

    //Job Card No

    public function setJobcard($name, $id): void
    {
        $this->jobcard_no = $name;
        $this->jobcard_id = $id;
        $this->getJobcardList();
    }

    public function enterJobcard(): void
    {
        $obj = $this->jobcardCollection[$this->highlightJobcard] ?? null;

        $this->jobcard_no = '';
        $this->jobcardCollection = Collection::empty();
        $this->highlightJobcard = 0;

        $this->jobcard_no = $obj['vname'] ?? '';;
        $this->jobcard_id = $obj['id'] ?? '';;
    }

    public function incrementJobcard(): void
    {
        if ($this->highlightJobcard === count($this->jobcardCollection) - 1) {
            $this->highlightJobcard = 0;
            return;
        }
        $this->highlightJobcard++;
    }

    public function decrementJobcard(): void
    {
        if ($this->highlightJobcard === 0) {
            $this->highlightJobcard = count($this->jobcardCollection) - 1;
            return;
        }
        $this->highlightJobcard--;
    }

    public function getJobcardList(): void
    {
        $this->jobcardCollection = $this->jobcard_no ? Jobcard::search(trim($this->jobcard_no))
            ->get() : Jobcard::all();
    }

    #[On('refresh-jobcard')]
    public function refreshJobcard($v): void
    {
        $this->jobcard_id = $v['id'];
        $this->jobcard_no = $v['name'];
        $this->jobcardTyped = false;
    }

    //Outward

    public function setPeOutward($name, $id): void
    {
        $this->pe_outward_no = $name;
        $this->pe_outward_id = $id;
        $this->getPeOutwardList();
    }

    public function enterPeOutward(): void
    {
        $obj = $this->peOutwardCollection[$this->highlightPeOutward] ?? null;

        $this->pe_outward_no = '';
        $this->peOutwardCollection = Collection::empty();
        $this->highlightPeOutward = 0;

        $this->pe_outward_no = $obj['vname'] ?? '';;
        $this->pe_outward_id = $obj['id'] ?? '';;
    }

    public function incrementPeOutward(): void
    {
        if ($this->highlightPeOutward === count($this->peOutwardCollection) - 1) {
            $this->highlightPeOutward = 0;
            return;
        }
        $this->highlightPeOutward++;
    }

    public function decrementPeOutward(): void
    {
        if ($this->highlightPeOutward === 0) {
            $this->highlightPeOutward = count($this->peOutwardCollection) - 1;
            return;
        }
        $this->highlightPeOutward--;
    }

    public function getPeOutwardList(): void
    {
        $data = DB::table('pe_outwards')
            ->select('pe_outwards.id as pe_outward_id',
                'pe_outwards.vno as vno',
                'contacts.id as contact_id',
                'colours.id as colour_id',
                'colours.vname as colour_name',
                'sizes.id as size_id',
                'sizes.vname as size_name',
                'pe_outward_items.qty',
                'pe_outward_items.id as pe_outward_item_id'
            )
            ->join('contacts', 'contacts.id', '=', 'pe_outwards.contact_id')
            ->join('pe_outward_items', 'pe_outwards.id', '=', 'pe_outward_items.pe_outward_id')
            ->join('colours', 'colours.id', '=', 'pe_outward_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'pe_outward_items.size_id')
            ->where('jobcard_id', '=', $this->jobcard_id)
            ->where('contact_id', '=', $this->contact_id)
            ->get()
            ->transform(function ($data) {
                return [
                    'pe_outward_item_id' => $data->pe_outward_item_id,
                    'pe_outward_id' => $data->pe_outward_id,
                    'pe_outward_no' => $data->vno,
                    'colour_id' => $data->colour_id,
                    'colour_name' => $data->colour_name,
                    'size_id' => $data->size_id,
                    'size_name' => $data->size_name,
                    'qty' => $data->qty + 0,
                ];
            });

        $this->peOutwardCollection = $data;

    }


    public $colour_name;
    public $colour_id;
    public $size_name;
    public $size_id;
    public $qty;
    public $pe_outward_item_id;

    public function sendPeOutwardItem($pe_outward_no, $pe_outward_id, $colour_name, $colour_id, $size_name, $size_id, $qty, $pe_outward_item_id): void
    {

        $this->pe_outward_no = $pe_outward_no;
        $this->pe_outward_id = $pe_outward_id;
        $this->pe_outward_item_id = $pe_outward_item_id;
        $this->colour_name = $colour_name;
        $this->colour_id = $colour_id;
        $this->size_name = $size_name;
        $this->size_id = $size_id;
        $this->qty = $qty;
    }


    public string $itemIndex = "";
    public $itemList = [];

    public function addItems(): void
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->colour_name)) &&
                !(empty($this->size_name)) &&
                !(empty($this->qty))
            ) {
                $this->itemList[] = [
                    'pe_outward_item_id' => $this->pe_outward_item_id,
                    'pe_outward_id' => $this->pe_outward_id,
                    'pe_outward_no' => $this->pe_outward_no,
                    'colour_id' => $this->colour_id,
                    'colour_name' => $this->colour_name,
                    'size_id' => $this->size_id,
                    'size_name' => $this->size_name,
                    'qty' => $this->qty,
                ];
                $this->calculateTotal();
                $this->resetsItems();
            }
        } else {
            $this->itemList[$this->itemIndex] = [
                'pe_outward_item_id' => $this->pe_outward_item_id,
                'pe_outward_id' => $this->pe_outward_id,
                'pe_outward_no' => $this->pe_outward_no,
                'colour_id' => $this->colour_id,
                'colour_name' => $this->colour_name,
                'size_id' => $this->size_id,
                'size_name' => $this->size_name,
                'qty' => $this->qty,
            ];
            $this->calculateTotal();
            $this->resetsItems();
            $this->render();
        }
//        $this->emit('getfocus');
    }

    public function resetsItems(): void
    {
        $this->pe_outward_no = '';
        $this->pe_outward_id = '';
        $this->pe_outward_item_id = '';
        $this->colour_name = '';
        $this->colour_id = '';
        $this->size_name = '';
        $this->size_id = '';
        $this->qty = '';
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;
        $items = $this->itemList[$index];
        $this->pe_outward_no = $items['pe_outward_no'];
        $this->pe_outward_id = $items['pe_outward_id'];
        $this->pe_outward_item_id = $items['pe_outward_item_id'];
        $this->colour_name = $items['colour_name'];
        $this->colour_id = $items['colour_id'];
        $this->size_name = $items['size_name'];
        $this->size_id = $items['size_id'];
        $this->qty = $items['qty'] + 0;
    }

    public function removeItems($index): void
    {
        unset($this->itemList[$index]);
        $this->itemList = collect($this->itemList);
        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        if ($this->itemList) {
            $this->total_qty = 0;
            foreach ($this->itemList as $row) {
                $this->total_qty += round(floatval($row['qty']), 3);
            }
        }
    }

    #[On('refresh-outward')]
    public function refreshOutward($v): void
    {
        $this->pe_outward_id = $v['id'];
        $this->pe_outward_no = $v['name'];
        $this->peOutwardTyped = false;
    }

    public $peInward;

    public function mount($id)
    {
        $this->vno = PeInward::nextNo();
        $this->vdate = Carbon::parse(Carbon::now())->format('Y-m-d');

        if ($id != 0) {

            $this->peInward = PeInward::find($id);
            $this->vid = $this->peInward->id;
            $this->vno = $this->peInward->vno;
            $this->vdate = $this->peInward->vdate;
            $this->contact_id = $this->peInward->contact_id;
            $this->contact_name = $this->peInward->contact->vname;
            $this->jobcard_id = $this->peInward->jobcard_id;
            $this->jobcard_no = $this->peInward->jobcard->vno;
            $this->total_qty = $this->peInward->total_qty;
            $this->receiver_details = $this->peInward->receiver_details;

            $data = DB::table('pe_inward_items')
                ->select('pe_inward_items.*',
                    'pe_outwards.vno as pe_outward_no',
                    'colours.vname as colour_name',
                    'sizes.vname as size_name'
                )
                ->join('pe_inwards', 'pe_inwards.id', '=', 'pe_inward_items.pe_inward_id')
                ->join('pe_outward_items', 'pe_outward_items.id', '=', 'pe_inward_items.pe_outward_item_id')
                ->join('pe_outwards', 'pe_outwards.id', '=', 'pe_outward_items.pe_outward_id')
                ->join('colours', 'colours.id', '=', 'pe_outward_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'pe_outward_items.size_id')
                ->where('pe_inward_id', '=', $id)
                ->get()
                ->transform(function ($data) {
                    return [
                        'pe_outward_item_id' => $data->pe_outward_item_id,
                        'pe_inward_id' => $data->pe_inward_id,
                        'pe_outward_no' => $data->pe_outward_no,
                        'colour_name' => $data->colour_name,
                        'size_name' => $data->size_name,
                        'qty' => $data->qty,
                    ];
                });

            $this->itemList = $data;

        }
    }

    public string $vid = '';

    public function save(): string
    {
        if ($this->contact_id != '') {

            if ($this->vid == "") {

                $obj = PeInward::create([
                    'vno' => $this->vno,
                    'vdate' => $this->vdate,
                    'contact_id' => $this->contact_id,
                    'jobcard_id' => $this->jobcard_id,
                    'total_qty' => $this->total_qty,
                    'receiver_details' => $this->receiver_details,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";

            } else {
                $obj = PeInward::find($this->vid);
                $obj->vno = $this->vno;
                $obj->vdate = $this->vdate;
                $obj->contact_id = $this->contact_id;
                $obj->jobcard_id = $this->jobcard_id;
                $obj->total_qty = $this->total_qty;
                $obj->receiver_details = $this->receiver_details;
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('pe_outward_items')->where('pe_outward_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
            }
            $this->getRoute();
            $this->vno = '';
            $this->vdate = '';
            $this->contact_id = '';
            $this->jobcard_id = '';
            $this->total_qty = '';
            return $message;
        }
        return '';
    }

    public function saveItem($id): void
    {
        foreach ($this->itemList as $sub) {
            PeInwardItem::create([
                'pe_inward_id' => $id,
                'pe_outward_item_id' => $sub['pe_outward_item_id'],
                'qty' => $sub['qty'],
            ]);
        }
    }

    public function setDelete()
    {
        DB::table('pe_inward_items')->where('pe_inward_id', '=', $this->vid)->delete();
        DB::table('pe_inwards')->where('id', '=', $this->vid)->delete();
        $this->getRoute();
    }

    public function getRoute(): void
    {
        $this->redirect(route('peinwards'));
    }


    public function render()
    {
        $this->getContactList();
        $this->getJobcardList();
        $this->getPeOutwardList();
        return view('livewire.erp.production.pe-inward.upsert');
    }
}
