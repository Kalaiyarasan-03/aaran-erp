<?php

namespace App\Livewire\Erp\Cutting;

use App\Livewire\Controls\Items\Common\ColourItem;
use App\Livewire\Controls\Items\Common\SizeItem;
use App\Livewire\Trait\CommonTrait;
use App\Models\Erp\Cutting;
use App\Models\Erp\CuttingItem;
use Carbon\Carbon;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTrait;

    public Cutting $cutting;
    public mixed $order_id = '';
    public mixed $order_name = '';
    public mixed $style_id = '';
    public mixed $style_name = '';
    public mixed $cutting_date = '';
    public mixed $cutting_master = '';
    public mixed $cutting_qty = '';
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
        $this->cutting_date = (Carbon::parse(Carbon::now())->format('Y-m-d'));

        if ($id) {
            $this->cutting = Cutting::find($id);
            $this->order_id = $this->cutting->order_id;
            $this->order_name = $this->cutting->order->vname;
            $this->style_id = $this->cutting->style_id;
            $this->style_name = $this->cutting->style->vname;
            $this->cutting_date = $this->cutting->cutting_date;
            $this->cutting_master = $this->cutting->cutting_master;
            $this->cutting_qty = $this->cutting->cutting_qty;
        }

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

        if ($this->qty = "0.0") {
            $this->qty = "";
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
        $this->dispatch('refresh-colour', ['id' => '', 'name' => ''])->to(ColourItem::class);
        $this->dispatch('refresh-size', ['id' => '', 'name' => ''])->to(SizeItem::class);
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

    public function getSave(): string
    {
        if ($this->order_id != '') {
            if ($this->vid == "") {
                $obj = Cutting::create([
                    'order_id' => $this->order_id,
                    'style_id' => $this->style_id,
                    'cutting_date' => $this->cutting_date,
                    'cutting_master' => $this->cutting_master,
                    'cutting_qty' => $this->cutting_qty,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";

            } else {
                $obj = Cutting::find($this->vid);
                $obj->order_id = $this->order_id;
                $obj->style_id = $this->style_id;
                $obj->cutting_date = $this->cutting_date;
                $obj->cutting_master = $this->cutting_master;
                $obj->cutting_qty = $this->cutting_qty;
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('cutting_items')->where('cutting_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
            }
            $this->order_id = '';
            $this->style_id = '';
            $this->cutting_date = '';
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

    public function getObj($id)
    {
        if ($id) {
            $obj = Cutting::find($id);
            $this->vid = $obj->id;
            $this->order_id = $obj->order_id;
            $this->cutting_date = $obj->cutting_date;
            $this->cutting_master = $obj->cutting_master;
            $this->cutting_qty = $obj->cutting_qty;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'id';

        return Cutting::search($this->searches)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function goTo()
    {
        $this->redirect(route('cuttings'));
    }

    public function reRender(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.erp.cutting.upsert');
    }
}