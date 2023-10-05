<?php

namespace App\Livewire\Erp\Production\Jobcard;

use App\Livewire\Controls\Items\Common\ColourItem;
use App\Livewire\Controls\Items\Common\SizeItem;
use App\Livewire\Controls\Items\Erp\Orders\FabricLotItem;
use App\Models\Erp\Jobcard;
use App\Models\Erp\JobcardItem;
use App\Models\Erp\PeInward;
use Carbon\Carbon;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Upsert extends Component
{
    public Jobcard $jobcard;
    public mixed $vid='';
    public mixed $vno = '';
    public mixed $vdate = '';
    public mixed $order_id = '';
    public mixed $order_name = '';
    public mixed $style_id = '';
    public mixed $style_name = '';
    public mixed $total_qty = '';
    public mixed $active_id = '1';
    public $list = [];
    public string $itemIndex = "";

    public mixed $jobcard_id = '';
    public mixed $fabric_lot_id = '';
    public string $fabric_lot_name = '';
    public mixed $colour_id = '';
    public string $colour_name = '';
    public mixed $size_id = '';
    public string $size_name = '';
    public mixed $qty = '';

    public function mount($id)
    {
        $this->vno = Jobcard::nextNo();
        $this->vdate = (Carbon::parse(Carbon::now())->format('Y-m-d'));

        if ($id != 0) {
            $this->jobcard = Jobcard::find($id);
            $this->vid = $this->jobcard->id;
            $this->vno = $this->jobcard->vno;
            $this->vdate = $this->jobcard->vdate;
            $this->order_id = $this->jobcard->order_id;
            $this->order_name = $this->jobcard->order->vname;
            $this->style_id = $this->jobcard->style_id;
            $this->style_name = $this->jobcard->style->vname;
            $this->total_qty = $this->jobcard->total_qty;
            $this->receiver_details = $this->jobcard->receiver_details;

            $data = DB::table('jobcard_items')->where('jobcard_id', '=', $id)
                ->join('fabric_lots', 'fabric_lots.id', '=', 'jobcard_items.fabric_lot_id')
                ->join('colours', 'colours.id', '=', 'jobcard_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'jobcard_items.size_id')
                ->select('jobcard_items.*', 'fabric_lots.vname as fabric_lot_name','colours.vname as colour_name', 'sizes.vname as size_name')
                ->get()
                ->transform(function ($data) {
                    return [
                        'jobcard_id' => $data->jobcard_id,
                        'fabric_lot_id' => $data->fabric_lot_id,
                        'fabric_lot_name' => $data->fabric_lot_name,
                        'colour_id' => $data->colour_id,
                        'colour_name' => $data->colour_name,
                        'size_id' => $data->size_id,
                        'size_name' => $data->size_name,
                        'qty' => $data->qty,
                    ];
                });

            $this->list = $data;
            $this->calculateTotal();
        }
    }

    public function calculateTotal(): void
    {
        if ($this->list) {
            $this->total_qty = 0;
            foreach ($this->list as $row) {
                $this->total_qty += round(floatval($row['qty']), 3);
            }
        }
    }

    public function addItems()
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->colour_name)) &&
                !(empty($this->size_name)) &&
                !(empty($this->qty))
            ) {
                $this->list[] = [
                    'fabric_lot_id' => $this->fabric_lot_id,
                    'fabric_lot_name' => $this->fabric_lot_name,
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
            $this->list[$this->itemIndex] = [
                'fabric_lot_id' => $this->fabric_lot_id,
                'fabric_lot_name' => $this->fabric_lot_name,
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

    public function resetsItems()
    {
        $this->fabric_lot_id = '';
        $this->fabric_lot_name = '';
        $this->colour_name = '';
        $this->colour_id = '';
        $this->size_name = '';
        $this->qty = '';
        $this->dispatch('refresh-fabric-lot', ['id' => '', 'name' => ''])->to(FabricLotItem::class);
        $this->dispatch('refresh-colour', ['id' => '', 'name' => ''])->to(ColourItem::class);
        $this->dispatch('refresh-size', ['id' => '', 'name' => ''])->to(SizeItem::class);
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;
        $items = $this->list[$index];
        $this->fabric_lot_name = $items['fabric_lot_name'];
        $this->fabric_lot_id = $items['fabric_lot_id'];
        $this->colour_name = $items['colour_name'];
        $this->colour_id = $items['colour_id'];
        $this->size_name = $items['size_name'];
        $this->size_id = $items['size_id'];
        $this->qty = floatval($items['qty']);

        $this->dispatch('refresh-fabric-lot-item', ['id' => $this->fabric_lot_id, 'name' => $this->fabric_lot_name])->to(FabricLotItem::class);
        $this->dispatch('refresh-colour-item', ['id' => $this->colour_id, 'name' => $this->colour_name])->to(ColourItem::class);
        $this->dispatch('refresh-size-item', ['id' => $this->size_id, 'name' => $this->size_name])->to(SizeItem::class);
    }

    public function removeItems($index)
    {
        unset($this->list[$index]);
        $this->list = collect($this->list);
        $this->calculateTotal();
    }


    #[On('refresh-order')]
    public function setOrder($v): void
    {
        $this->order_id = $v['id'];
    }
    #[On('refresh-style')]
    public function setStyle($v): void
    {
        $this->style_id = $v['id'];
    }

    #[On('refresh-fabric-lot')]
    public function setFabricLot($v): void
    {
        $this->fabric_lot_id = $v['id'];
        $this->fabric_lot_name = $v['name'];
    }

    #[On('refresh-colour')]
    public function setColour($v): void
    {
        $this->colour_id = $v['id'];
        $this->colour_name = $v['name'];
    }

    #[On('refresh-size')]
    public function setSize($v): void
    {
        $this->size_id = $v['id'];
        $this->size_name = $v['name'];
    }

    public function save(): string
    {
        if ($this->order_id != '') {
            if ($this->vid == "") {
                $obj = PeInward::create([
                    'vno' => $this->vno,
                    'vdate' => $this->vdate,
                    'order_id' => $this->order_id,
                    'style_id' => $this->style_id,
                    'total_qty' => $this->total_qty,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";
                $this->getRoute();

            } else {
                $obj = PeInward::find($this->vid);
                $obj->vno = $this->vno;
                $obj->vdate = $this->vdate;
                $obj->order_id = $this->order_id;
                $obj->style_id = $this->style_id;
                $obj->total_qty = $this->total_qty;
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('jobcard_items')->where('jobcard_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
                $this->getRoute();
            }
            $this->vno = '';
            $this->vdate = '';
            $this->order_id = '';
            $this->style_id = '';
            $this->total_qty = '';
            return $message;
        }
        return '';
    }

    public function saveItem($id): void
    {
        foreach ($this->list as $sub) {
            JobcardItem::create([
                'jobcard_id' => $id,
                'colour_id' => $sub['colour_id'],
                'fabric_lot_id' => $sub['fabric_lot_id'],
                'size_id' => $sub['size_id'],
                'qty' => $sub['qty'],
            ]);
        }
    }

    public function setDelete()
    {
        DB::table('jobcard_items')->where('jobcard_id', '=', $this->vid)->delete();
        DB::table('jobcards')->where('id', '=', $this->vid)->delete();
        $this->getRoute();
    }

    public function getRoute(): void
    {
        $this->redirect(route('jobcards'));
    }

    public function render()
    {
        return view('livewire.erp.production.jobcard.upsert');
    }
}
