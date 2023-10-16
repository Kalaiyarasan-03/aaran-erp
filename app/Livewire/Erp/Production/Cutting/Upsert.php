<?php

namespace App\Livewire\Erp\Production\Cutting;

use App\Livewire\Controls\Items\Common\ColourItem;
use App\Livewire\Controls\Items\Common\SizeItem;
use App\Livewire\Controls\Items\Erp\Production\JobcardItem;
use App\Models\Erp\Cutting;
use App\Models\Erp\CuttingItem;
use Carbon\Carbon;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Upsert extends Component
{
    public Cutting $cutting;

    public mixed $vid='';
    public mixed $vno = '';
    public mixed $vdate = '';
    public mixed $order_id = '';
    public mixed $order_name = '';
    public mixed $jobcard_id = '';
    public mixed $jobcard_name = '';
    public mixed $cutting_master = '';
    public mixed $cutting_qty = '';
    public mixed $active_id = '1';
    public $list = [];
    public string $itemIndex = "";

    public mixed $cutting_id = '';
    public mixed $colour_id = '';
    public string $colour_name = '';
    public mixed $size_id = '';
    public string $size_name = '';
    public mixed $qty = '';

    public function mount($id)
    {
        $this->vno = Cutting::nextNo();
        $this->vdate = (Carbon::parse(Carbon::now())->format('Y-m-d'));

        if ($id != 0) {
            $this->cutting = Cutting::find($id);
            $this->vid = $this->cutting->id;
            $this->vno = $this->cutting->vno;
            $this->vdate = $this->cutting->vdate;
            $this->order_id = $this->cutting->order_id;
            $this->order_name = $this->cutting->order->vname;
            $this->jobcard_id = $this->cutting->jobcard_id;
            $this->jobcard_name = $this->cutting->jobcard->vno;
            $this->cutting_master = $this->cutting->cutting_master;
            $this->cutting_qty = $this->cutting->cutting_qty;

            $data = DB::table('cutting_items')->where('cutting_id', '=', $id)
                ->join('colours', 'colours.id', '=', 'cutting_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'cutting_items.size_id')
                ->select('cutting_items.*', 'colours.vname as colour_name', 'sizes.vname as size_name')
                ->get()
                ->transform(function ($data) {
                    return [
                        'cutting_id' => $data->cutting_id,
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
            $this->cutting_qty = 0;
            foreach ($this->list as $row) {
                $this->cutting_qty += round(floatval($row['qty']), 3);
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
        $this->colour_name = '';
        $this->colour_id = '';
        $this->size_name = '';
        $this->qty = '';
        $this->dispatch('refresh-colour-item', ['id' => '', 'name' => ''])->to(ColourItem::class);
        $this->dispatch('refresh-size-item', ['id' => '', 'name' => ''])->to(SizeItem::class);
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;
        $items = $this->list[$index];
        $this->colour_name = $items['colour_name'];
        $this->colour_id = $items['colour_id'];
        $this->size_name = $items['size_name'];
        $this->size_id = $items['size_id'];
        $this->qty = floatval($items['qty']);

        $this->dispatch('refresh-colour-item', ['id' => $this->colour_id, 'name' => $this->colour_name])->to(ColourItem::class);
        $this->dispatch('refresh-size-item', ['id' => $this->size_id, 'name' => $this->size_name])->to(SizeItem::class);
    }

    public function removeItems($index)
    {
        unset($this->list[$index]);
        $this->list = collect($this->list);
        $this->calculateTotal();
    }

    #[On('refresh-cutting-jobcard')]
    public function refreshCuttingJobcard($v)
    {
        $this->colour_id = $v['colour_id'];
        $this->colour_name = $v['colour_name'];
        $this->size_id = $v['size_id'];
        $this->size_name = $v['size_name'];
        $this->qty = $v['qty'];
    }

    #[On('refresh-order')]
    public function setOrder($v): void
    {
        $this->order_id = $v['id'];

    }
    #[On('refresh-jobcard')]
    public function setJobcard($v): void
    {
        $this->jobcard_id = $v['id'];
        $this->jobcard_name = $v['name'];
        $this->dispatch('refresh-with-job', ['id' => $this->jobcard_id, 'name' => $this->jobcard_name])->to(JobcardItem::class);
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
                $obj = Cutting::create([
                    'vno' => $this->vno,
                    'vdate' => $this->vdate,
                    'order_id' => $this->order_id,
                    'jobcard_id' => $this->jobcard_id,
                    'cutting_master' => $this->cutting_master,
                    'cutting_qty' => $this->cutting_qty,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";
                $this->getRoute();

            } else {
                $obj = Cutting::find($this->vid);
                $obj->vno = $this->vno;
                $obj->vdate = $this->vdate;
                $obj->order_id = $this->order_id;
                $obj->jobcard_id = $this->jobcard_id;
                $obj->cutting_master = $this->cutting_master;
                $obj->cutting_qty = $this->cutting_qty;
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('cutting_items')->where('cutting_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
                $this->getRoute();
            }
            $this->vno = '';
            $this->vdate = '';
            $this->order_id = '';
            $this->jobcard_id = '';
            $this->cutting_master = '';
            $this->cutting_qty = '';
            return $message;
        }
        return '';
    }

    public function saveItem($id): void
    {
        foreach ($this->list as $sub) {
            CuttingItem::create([
                'cutting_id' => $id,
                'colour_id' => $sub['colour_id'],
                'size_id' => $sub['size_id'],
                'qty' => $sub['qty'],
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
        return view('livewire.erp.production.cutting.upsert');
    }
}
