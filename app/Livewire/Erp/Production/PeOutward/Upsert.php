<?php

namespace App\Livewire\Erp\Production\PeOutward;

use App\Models\Erp\Production\Jobcard;
use App\Models\Erp\Production\PeOutward;
use App\Models\Erp\Production\PeOutwardItem;
use App\Models\Master\Contact;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Upsert extends Component
{

    //
    // Contact
    //
    public string $contact_name = '';
    public string $contact_id = '';
    public Collection $contactCollection;
    public int $highlightContact = 0;
    public bool $contactTyped = false;

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
    //
    // Job Card
    //
    public string $jobcard_id = '';
    public string $jobcard_no = '';
    public Collection $jobcardCollection;
    public int $highlightJobcard = 0;
    public bool $jobcardTyped = false;

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
    //
    //Cutting
    //
    public string $cutting_id = '';
    public string $cutting_no = '';
    public Collection $cuttingCollection;
    public int $highlightCutting = 0;
    public bool $cuttingTyped = false;
    public string $style_name = '';

    public function incrementCutting(): void
    {
        if ($this->highlightCutting === count($this->cuttingCollection) - 1) {
            $this->highlightCutting = 0;
            return;
        }
        $this->highlightCutting++;
    }

    public function decrementCutting(): void
    {
        if ($this->highlightCutting === 0) {
            $this->highlightCutting = count($this->cuttingCollection) - 1;
            return;
        }
        $this->highlightCutting--;
    }

    public function setCutting($name, $id): void
    {
        $this->cutting_no = $name;
        $this->cutting_id = $id;
        $this->getCuttingList();
    }

    public function enterCutting(): void
    {
        $obj = $this->cuttingCollection[$this->highlightCutting] ?? null;

        $this->cutting_no = '';
        $this->cuttingCollection = Collection::empty();
        $this->highlightCutting = 0;

        $this->cutting_no = $obj['vname'] ?? '';;
        $this->cutting_id = $obj['id'] ?? '';;
    }

    public function getCuttingList(): void
    {

        $data = DB::table('jobcards')
            ->select(
                'jobcard_items.id as jobcard_item_id',
                'cuttings.vno as cutting_no',
                'cuttings.id as cutting_id',
                'colours.vname as colour_name',
                'sizes.vname as size_name',
                'cutting_items.qty'
            )
            ->join('jobcard_items', 'jobcard_items.jobcard_id', '=', 'jobcards.id')
//            ->join('cuttings', 'cuttings.jobcard_id', '=', 'jobcards.id')
            ->join('cutting_items', 'cutting_items.cutting_id', '=', 'cuttings.id')
            ->join('colours', 'jobcard_items.colour_id', '=', 'colours.id')
            ->join('sizes', 'jobcard_items.size_id', '=', 'sizes.id')
            ->where('jobcards.id', '=', $this->jobcard_id)
            ->get()
            ->transform(function ($data) {
                return [
                    'jobcard_item_id' => $data->jobcard_item_id,
                    'cutting_no' => $data->cutting_no,
                    'cutting_id' => $data->cutting_id,
                    'colour_name' => $data->colour_name,
                    'size_name' => $data->size_name,
                    'qty' => $data->qty + 0,
                ];
            });

        $this->cuttingCollection = $data;

    }
    //
    // properties
    //
    public string $vno = '';
    public string $vdate = '';
    public mixed $total_qty = 0;
    public mixed $receiver_details = '';
    public string $active_id = '1';
    public string $vid = '';

    public function mount($id)
    {
        $this->vno = PeOutward::nextNo();
        $this->vdate = Carbon::parse(Carbon::now())->format('Y-m-d');

        if ($id != 0) {

            $obj = PeOutward::find($id);
            $this->vid = $obj->id;
            $this->vno = $obj->vno;
            $this->vdate = $obj->vdate;
            $this->contact_id = $obj->contact_id;
            $this->contact_name = $obj->contact->vname;
            $this->jobcard_id = $obj->jobcard_id;
            $this->jobcard_no = $obj->jobcard->vno;
            $this->total_qty = $obj->total_qty;
            $this->receiver_details = $obj->receiver_details;

            $data = DB::table('pe_outward_items')->where('pe_outward_id', '=', $id)
                ->join('cuttings', 'cuttings.id', '=', 'pe_outward_items.cutting_id')
                ->join('colours', 'colours.id', '=', 'pe_outward_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'pe_outward_items.size_id')
                ->select('pe_outward_items.*', 'cuttings.vno as cutting_no', 'colours.vname as colour_name', 'sizes.vname as size_name')
                ->get()
                ->transform(function ($data) {
                    return [
                        'cutting_id' => $data->cutting_id,
                        'cutting_no' => $data->cutting_no,
                        'colour_id' => $data->colour_id,
                        'colour_name' => $data->colour_name,
                        'size_id' => $data->size_id,
                        'size_name' => $data->size_name,
                        'qty' => $data->qty,
                    ];
                });

            $this->itemList = $data;

        }
    }


    public string $itemIndex = "";
    public $itemList = [];

    public $colour_name;
    public $colour_id;
    public $size_name;
    public $size_id;
    public $qty;

    public function sendCuttingItem($cutting_no, $cutting_id, $colour_name, $colour_id, $size_name, $size_id, $qty): void
    {

        $this->cutting_no = $cutting_no;
        $this->cutting_id = $cutting_id;
        $this->colour_name = $colour_name;
        $this->colour_id = $colour_id;
        $this->size_name = $size_name;
        $this->size_id = $size_id;
        $this->qty = $qty;
    }

    public function addItems(): void
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->colour_name)) &&
                !(empty($this->size_name)) &&
                !(empty($this->qty))
            ) {
                $this->itemList[] = [
                    'cutting_id' => $this->cutting_id,
                    'cutting_no' => $this->cutting_no,
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
                'cutting_id' => $this->cutting_id,
                'cutting_no' => $this->cutting_no,
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
        $this->cutting_no = '';
        $this->cutting_id = '';
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
        $this->cutting_no = $items['cutting_no'];
        $this->cutting_id = $items['cutting_id'];
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

    public function calculateTotal()
    {
        if ($this->itemList) {
            $this->total_qty = 0;
            foreach ($this->itemList as $row) {
                $this->total_qty += round(floatval($row['qty']), 3);
            }
        }
    }


    public function save(): string
    {
        if ($this->contact_id != '') {

            if ($this->vid == "") {

                $obj = PeOutward::create([
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
                $obj = PeOutward::find($this->vid);
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
            PeOutwardItem::create([
                'pe_outward_id' => $id,
                'jobcard_item_id' => $sub['jobcard_item_id'],
                'qty' => $sub['qty'],
            ]);
        }
    }

    public function setDelete()
    {
        DB::table('pe_outward_items')->where('pe_outward_id', '=', $this->vid)->delete();
        DB::table('pe_outwards')->where('id', '=', $this->vid)->delete();
        $this->getRoute();
    }

    public function getRoute(): void
    {
        $this->redirect(route('peoutwards'));
    }


    public function render()
    {
        $this->getContactList();
        $this->getJobcardList();
        $this->getCuttingList();
        return view('livewire.erp.production.pe-outward.upsert');
    }
}
