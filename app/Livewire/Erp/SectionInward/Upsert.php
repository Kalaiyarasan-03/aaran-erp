<?php

namespace App\Livewire\Erp\SectionInward;

use App\Livewire\Controls\Items\Common\ColourItem;
use App\Livewire\Controls\Items\Common\SizeItem;
use App\Models\Erp\SectionInward;
use App\Models\Erp\SectionInwardItem;
use Carbon\Carbon;
use Livewire\Attributes\On;
use DB;
use Livewire\Component;

class Upsert extends Component
{
    public SectionInward $sectionInward;
    public mixed $vid='';
    public mixed $vno = '';
    public mixed $vdate = '';
    public mixed $contact_id = '';
    public mixed $contact_name = '';
    public mixed $order_id = '';
    public mixed $order_name = '';
    public mixed $style_id = '';
    public mixed $style_name = '';
    public mixed $total_qty = '';
    public mixed $receiver_details = '';
    public mixed $active_id = '1';
    public $list = [];
    public string $itemIndex = "";

    public mixed $sectionInward_id = '';
    public mixed $colour_id = '';
    public string $colour_name = '';
    public mixed $size_id = '';
    public string $size_name = '';
    public mixed $qty = '';

    public function mount($id)
    {
        $this->vno = SectionInward::nextNo();
        $this->vdate = (Carbon::parse(Carbon::now())->format('Y-m-d'));

        if ($id != 0) {
            $this->sectionInward = SectionInward::find($id);
            $this->vid = $this->sectionInward->id;
            $this->vno = $this->sectionInward->vno;
            $this->vdate = $this->sectionInward->vdate;
            $this->contact_id = $this->sectionInward->contact_id;
            $this->contact_name = $this->sectionInward->contact->vname;
            $this->order_id = $this->sectionInward->order_id;
            $this->order_name = $this->sectionInward->order->vname;
            $this->style_id = $this->sectionInward->style_id;
            $this->style_name = $this->sectionInward->style->vname;
            $this->total_qty = $this->sectionInward->total_qty;
            $this->receiver_details = $this->sectionInward->receiver_details;

            $data = DB::table('section_inward_items')->where('section_inward_id', '=', $id)
                ->join('colours', 'colours.id', '=', 'section_inward_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'section_inward_items.size_id')
                ->select('section_inward_items.*', 'colours.vname as colour_name', 'sizes.vname as size_name')
                ->get()
                ->transform(function ($data) {
                    return [
                        'section_inward_id' => $data->section_inward_id,
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
        $this->dispatch('refresh-size-item', ['id' => $this->size_id, 'name' => $this->size_name])->to(SizeItem::class);
    }

    public function removeItems($index)
    {
        unset($this->list[$index]);
        $this->list = collect($this->list);
        $this->calculateTotal();
    }

    #[On('refresh-contact')]
    public function setContact($v): void
    {
        $this->contact_id = $v['id'];
        $this->contact_name = $v['name'];
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
                $obj = SectionInward::create([
                    'vno' => $this->vno,
                    'vdate' => $this->vdate,
                    'contact_id' => $this->contact_id,
                    'order_id' => $this->order_id,
                    'style_id' => $this->style_id,
                    'total_qty' => $this->total_qty,
                    'receiver_details' => $this->receiver_details,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";
                $this->getRoute();

            } else {
                $obj = SectionInward::find($this->vid);
                $obj->vno = $this->vno;
                $obj->vdate = $this->vdate;
                $obj->contact_id = $this->contact_id;
                $obj->order_id = $this->order_id;
                $obj->style_id = $this->style_id;
                $obj->total_qty = $this->total_qty;
                $obj->receiver_details = $this->receiver_details;
                $obj->active_id = $this->active_id ?: '0';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('section_inward_items')->where('section_inward_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
                $this->getRoute();
            }
            $this->vno = '';
            $this->vdate = '';
            $this->order_id = '';
            $this->style_id = '';
            $this->contact_id = '';
            $this->contact_name = '';
            $this->total_qty = '';
            $this->receiver_details = '';
            return $message;
        }
        return '';
    }

    public function saveItem($id): void
    {
        foreach ($this->list as $sub) {
            SectionInwardItem::create([
                'section_inward_id' => $id,
                'colour_id' => $sub['colour_id'],
                'size_id' => $sub['size_id'],
                'qty' => $sub['qty'],
            ]);
        }
    }

    public function setDelete()
    {
        DB::table('section_inward_items')->where('section_inward_id', '=', $this->vid)->delete();
        DB::table('section_inwards')->where('id', '=', $this->vid)->delete();
        $this->getRoute();
    }

    public function getRoute(): void
    {
        $this->redirect(route('sectioninwards'));
    }
    public function render()
    {
        return view('livewire.erp.section-inward.upsert');
    }
}
