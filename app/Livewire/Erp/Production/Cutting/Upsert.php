<?php

namespace App\Livewire\Erp\Production\Cutting;

use App\Models\Common\Colour;
use App\Models\Common\Size;
use App\Models\Erp\Order;
use App\Models\Erp\Production\Cutting;
use App\Models\Erp\Production\CuttingItem;
use App\Models\Erp\Production\Jobcard;
use App\Models\Erp\Production\JobcardItem;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Upsert extends Component
{
    //
    // Order no
    //
    public $order_id = '';
    public $order_no = '';
    public Collection $orderCollection;
    public $highlightOrder = 0;
    public $orderTyped = false;

    public function decrementOrder(): void
    {
        if ($this->highlightOrder === 0) {
            $this->highlightOrder = count($this->orderCollection) - 1;
            return;
        }
        $this->highlightOrder--;
    }

    public function incrementOrder(): void
    {
        if ($this->highlightOrder === count($this->orderCollection) - 1) {
            $this->highlightOrder = 0;
            return;
        }
        $this->highlightOrder++;
    }

    public function enterOrder(): void
    {
        $obj = $this->orderCollection[$this->highlightOrder] ?? null;

        $this->order_no = '';
        $this->orderCollection = Collection::empty();
        $this->highlightOrder = 0;

        $this->order_no = $obj['vname'] ?? '';;
        $this->order_id = $obj['id'] ?? '';;

        $this->jobcard_id = '';
        $this->jobcard_no = '';
    }

    public function setOrder($name, $id): void
    {
        $this->order_no = $name;
        $this->order_id = $id;

        $this->jobcard_id = '';
        $this->jobcard_no = '';

        $this->getOrderList();
    }

    #[On('refresh-order')]
    public function refreshContact($v): void
    {
        $this->order_id = $v['id'];
        $this->order_no = $v['name'];

        $this->orderTyped = false;

        $this->jobcard_id = '';
        $this->jobcard_no = '';

    }

    public function getOrderList(): void
    {
        $this->orderCollection = $this->order_no ? Order::search(trim($this->order_no))
            ->get() : Order::all();
    }

    //
    // Job no
    //

    public $jobcard_id = '';
    public $jobcard_no = '';
    public Collection $jobcardCollection;
    public $highlightJobcard = 0;
    public $jobcardTyped = false;

    public function decrementJobcard(): void
    {
        if ($this->highlightJobcard === 0) {
            $this->highlightJobcard = count($this->jobcardCollection) - 1;
            return;
        }
        $this->highlightJobcard--;
    }

    public function incrementJobcard(): void
    {
        if ($this->highlightJobcard === count($this->jobcardCollection) - 1) {
            $this->highlightJobcard = 0;
            return;
        }
        $this->highlightJobcard++;
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

    public function setJobcard($name, $id): void
    {
        $this->jobcard_no = $name;
        $this->jobcard_id = $id;
        $this->getJobcardList();
    }

    #[On('refresh-jobcard')]
    public function refreshJobcard($v): void
    {
        $this->jobcard_id = $v['id'];
        $this->jobcard_no = $v['name'];
        $this->jobcardTyped = false;

    }

    public function getJobcardList(): void
    {
        if ($this->order_id) {
            $this->jobcardCollection = $this->jobcard_no ? Jobcard::search(trim($this->jobcard_no))
                ->where('order_id', '=', $this->order_id)
                ->get() : Jobcard::where('order_id', '=', $this->order_id)->get();
        }

    }

    //
    // Job List
    //

    public $jobcard_item_id = '';
    public $jobcard_item_name = '';
    public Collection $jobcardItemCollection;
    public $highlightJobcardItem = 0;
    public $jobcardItemTyped = false;

    public function decrementJobcardItem(): void
    {
        if ($this->highlightJobcardItem === 0) {
            $this->highlightJobcardItem = count($this->jobcardItemCollection) - 1;
            return;
        }
        $this->highlightJobcardItem--;
    }

    public function incrementJobcardItem(): void
    {
        if ($this->highlightJobcardItem === count($this->jobcardItemCollection) - 1) {
            $this->highlightJobcardItem = 0;
            return;
        }
        $this->highlightJobcardItem++;
    }

    public function enterJobcardItem(): void
    {
        $obj = $this->jobcardItemCollection[$this->highlightJobcardItem] ?? null;

        $this->jobcard_item_id = '';
        $this->jobcardItemCollection = Collection::empty();
        $this->highlightJobcardItem = 0;

        $this->jobcard_item_id = $obj['jobcard_item_id'] ?? '';
        $this->fabric_lot_id = $obj['fabric_lot_id'] ?? '';
        $this->fabric_lot_no = $obj['fabric_lot_no'] ?? '';
        $this->colour_id = $obj['colour_id'] ?? '';
        $this->colour_name = $obj['colour_name'] ?? '';
        $this->size_id = $obj['size_id'] ?? '';
        $this->size_name = $obj['size_name'] ?? '';
        $this->qty = $obj['qty'] ?? '';
    }

    public function setJobcardItem($id, $lot, $lot_id, $colour_id, $size_id, $colour, $size, $qty): void
    {
        $this->jobcard_item_id = $id;
        $this->fabric_lot_id = $lot_id;
        $this->fabric_lot_no = $lot;
        $this->colour_id = $colour_id;
        $this->colour_name = $colour;
        $this->size_name = $size;
        $this->size_id = $size_id;
        $this->qty = $qty + 0;
        $this->getJobcardItemList();
    }

    public function getJobcardItemList(): void
    {
        $data = DB::table('jobcard_items')
            ->select('jobcard_items.id',
                'jobcard_items.fabric_lot_id',
                'jobcard_items.colour_id',
                'jobcard_items.size_id',
                'jobcard_items.qty',
                'fabric_lots.vname as fabric_lot_no',
                'colours.vname as colour_name',
                'sizes.vname as size_name'
            )
            ->join('fabric_lots', 'fabric_lots.id', '=', 'jobcard_items.fabric_lot_id')
            ->join('colours', 'colours.id', '=', 'jobcard_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'jobcard_items.size_id')
            ->where('jobcard_id', '=', $this->jobcard_id)
            ->get()
            ->transform(function ($data) {
                return [
                    'jobcard_item_id' => $data->id,
                    'fabric_lot_id' => $data->fabric_lot_id,
                    'fabric_lot_no' => $data->fabric_lot_no,
                    'colour_id' => $data->colour_id,
                    'colour_name' => $data->colour_name,
                    'size_id' => $data->size_id,
                    'size_name' => $data->size_name,
                    'qty' => $data->qty + 0,
                ];
            });

        $this->jobcardItemCollection = $data;
    }


    //
    // properties
    //

    public string $vid = '';
    public string $vno = '';
    public string $vdate = '';
    public string $cutting_master = '';
    public mixed $total_qty = 0;
    public string $itemIndex = "";
    public $itemList = [];
    public mixed $fabric_lot_id;
    public mixed $fabric_lot_no;
    public mixed $colour_id;
    public mixed $colour_name;
    public mixed $size_id;
    public mixed $size_name;
    public mixed $qty;

    //
    // mount
    //

    public function mount($id): void
    {
        $this->vno = Cutting::nextNo();
        $this->vdate = Carbon::parse(Carbon::now())->format('Y-m-d');

        if ($id != 0) {

            $obj = Cutting::find($id);
            $this->vid = $obj->id;
            $this->vno = $obj->vno;
            $this->vdate = $obj->vdate;
            $this->order_id = $obj->order_id;
            $this->order_no = $obj->order->vname;
            $this->jobcard_id = $obj->jobcard_id;
            $this->jobcard_no = $obj->jobcard->vno;
            $this->cutting_master = $obj->cutting_master;
            $this->total_qty = $obj->total_qty;

            $data = DB::table('cutting_items')
                ->select('cutting_items.*',
                    'cutting_items.jobcard_item_id',
                    'cutting_items.fabric_lot_id',
                    'cutting_items.colour_id',
                    'cutting_items.size_id',
                    'cutting_items.qty',
                    'fabric_lots.vname as fabric_lot_no',
                    'colours.vname as colour_name',
                    'sizes.vname as size_name'
                )
                ->join('cuttings', 'cuttings.id', '=', 'cutting_items.cutting_id')
                ->join('jobcard_items', 'jobcard_items.id', '=', 'cutting_items.jobcard_item_id')
                ->join('fabric_lots', 'fabric_lots.id', '=', 'jobcard_items.fabric_lot_id')
                ->join('colours', 'colours.id', '=', 'jobcard_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'jobcard_items.size_id')
                ->where('cutting_id', '=', $id)
                ->get()
                ->transform(function ($data) {
                    return [
                        'jobcard_item_id' => $data->jobcard_item_id,
                        'fabric_lot_id' => $data->fabric_lot_id,
                        'fabric_lot_no' => $data->fabric_lot_no,
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

    //
    // add items
    //
    public function addItems(): void
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->colour_name)) &&
                !(empty($this->size_name)) &&
                !(empty($this->qty))
            ) {
                $this->itemList[] = [
                    'jobcard_item_id' => $this->jobcard_item_id,
                    'fabric_lot_id' => $this->fabric_lot_id,
                    'fabric_lot_no' => $this->fabric_lot_no,
                    'colour_id' => $this->colour_id,
                    'colour_name' => $this->colour_name,
                    'size_id' => $this->size_id,
                    'size_name' => $this->size_name,
                    'qty' => $this->qty,
                ];
            }
        } else {
            $this->itemList[$this->itemIndex] = [
                'jobcard_item_id' => $this->jobcard_item_id,
                'fabric_lot_id' => $this->fabric_lot_id,
                'fabric_lot_no' => $this->fabric_lot_no,
                'colour_id' => $this->colour_id,
                'colour_name' => $this->colour_name,
                'size_id' => $this->size_id,
                'size_name' => $this->size_name,
                'qty' => $this->qty,
            ];

        }

        $this->calculateTotal();
        $this->resetsItems();
        $this->render();
//        $this->emit('getfocus');
    }

    public function resetsItems(): void
    {
        $this->itemIndex = '';
        $this->jobcard_item_id = '';
        $this->fabric_lot_id = '';
        $this->fabric_lot_no = '';
        $this->colour_id = '';
        $this->colour_name = '';
        $this->size_id = '';
        $this->size_name = '';
        $this->qty = '';
        $this->calculateTotal();
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;

        $items = $this->itemList[$index];
        $this->jobcard_item_id = $items['jobcard_item_id'];
        $this->fabric_lot_id = $items['fabric_lot_id'];
        $this->fabric_lot_no = $items['fabric_lot_no'];
        $this->colour_id = $items['colour_id'];
        $this->colour_name = $items['colour_name'];
        $this->size_id = $items['size_id'];
        $this->size_name = $items['size_name'];
        $this->qty = $items['qty'] + 0;
        $this->calculateTotal();
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

    //
    // save
    //

    public function save(): string
    {
        if ($this->order_id != '') {

            if ($this->vid == "") {

                $obj = Cutting::create([
                    'vno' => $this->vno,
                    'vdate' => $this->vdate,
                    'order_id' => $this->order_id,
                    'jobcard_id' => $this->jobcard_id,
                    'cutting_master' => $this->cutting_master,
                    'total_qty' => $this->total_qty,
                    'active_id' => '1',
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";

            } else {
                $obj = Cutting::find($this->vid);
                $obj->vno = $this->vno;
                $obj->vdate = $this->vdate;
                $obj->order_id = $this->order_id;
                $obj->jobcard_id = $this->jobcard_id;
                $obj->cutting_master = $this->cutting_master;
                $obj->total_qty = $this->total_qty;
                $obj->active_id = '1';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('cutting_items')->where('cutting_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
            }
            $this->getRoute();
            $this->vno = '';
            $this->vdate = '';
            $this->order_id = '';
            $this->jobcard_id = '';
            $this->total_qty = '';
            return $message;
        }
        return '';
    }

    public function saveItem($id): void
    {
        foreach ($this->itemList as $sub) {
            CuttingItem::create([
                'cutting_id' => $id,
                'jobcard_item_id' => $sub['jobcard_item_id'],
                'fabric_lot_id' => $sub['fabric_lot_id'],
                'colour_id' => $sub['colour_id'],
                'size_id' => $sub['size_id'],
                'qty' => $sub['qty'],
                'active_id' => '1'
            ]);
        }
    }

    public function setDelete()
    {
        DB::table('cutting_items')->where('cutting_id', '=', $this->vid)->delete();
        DB::table('cuttings')->where('id', '=', $this->vid)->delete();
        $this->getRoute();
    }

    public function getRoute(): void
    {
        $this->redirect(route('cuttings'));
    }


    public function render()
    {
        $this->getOrderList();
        $this->getJobcardList();
        $this->getJobcardItemList();

        return view('livewire.erp.production.cutting.upsert');
    }
}
