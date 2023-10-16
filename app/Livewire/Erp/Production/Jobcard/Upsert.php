<?php

namespace App\Livewire\Erp\Production\Jobcard;

use App\Models\Common\Colour;
use App\Models\Common\Size;
use App\Models\Erp\Fabrication\FabricLot;
use App\Models\Erp\Order;
use App\Models\Erp\PeInward;
use App\Models\Erp\Production\Jobcard;
use App\Models\Erp\Production\JobcardItem;
use App\Models\Erp\Style;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
    }

    public function setOrder($name, $id): void
    {
        $this->order_no = $name;
        $this->order_id = $id;
        $this->getOrderList();
    }

    #[On('refresh-order')]
    public function refreshContact($v): void
    {
        $this->order_id = $v['id'];
        $this->order_no = $v['name'];
        $this->orderTyped = false;

    }

    public function getOrderList(): void
    {
        $this->orderCollection = $this->order_no ? Order::search(trim($this->order_no))
            ->get() : Order::all();
    }

    //
    // Style no
    //

    public $style_id = '';
    public $style_name = '';
    public Collection $styleCollection;
    public $highlightStyle = 0;
    public $styleTyped = false;

    public function decrementStyle(): void
    {
        if ($this->highlightStyle === 0) {
            $this->highlightStyle = count($this->styleCollection) - 1;
            return;
        }
        $this->highlightStyle--;
    }

    public function incrementStyle(): void
    {
        if ($this->highlightStyle === count($this->styleCollection) - 1) {
            $this->highlightStyle = 0;
            return;
        }
        $this->highlightStyle++;
    }

    public function enterStyle(): void
    {
        $obj = $this->styleCollection[$this->highlightStyle] ?? null;

        $this->style_name = '';
        $this->styleCollection = Collection::empty();
        $this->highlightStyle = 0;

        $this->style_name = $obj['vname'] ?? '';;
        $this->style_id = $obj['id'] ?? '';;
    }

    public function setStyle($name, $id): void
    {
        $this->style_name = $name;
        $this->style_id = $id;
        $this->getStyleList();
    }

    #[On('refresh-style')]
    public function refreshStyle($v): void
    {
        $this->style_id = $v['id'];
        $this->style_name = $v['name'];
        $this->styleTyped = false;

    }

    public function getStyleList(): void
    {
        $this->styleCollection = $this->style_name ? Style::search(trim($this->style_name))
            ->get() : Style::all();
    }

    //
    // Fabric Lot
    //

    public $fabric_lot_id = '';
    public $fabric_lot_name = '';
    public Collection $fabricLotCollection;
    public $highlightFabricLot = 0;
    public $fabricLotTyped = false;

    public function decrementFabricLot(): void
    {
        if ($this->highlightFabricLot === 0) {
            $this->highlightFabricLot = count($this->fabricLotCollection) - 1;
            return;
        }
        $this->highlightFabricLot--;
    }

    public function incrementFabricLot(): void
    {
        if ($this->highlightFabricLot === count($this->fabricLotCollection) - 1) {
            $this->highlightFabricLot = 0;
            return;
        }
        $this->highlightFabricLot++;
    }

    public function enterFabricLot(): void
    {
        $obj = $this->fabricLotCollection[$this->highlightFabricLot] ?? null;

        $this->fabric_lot_name = '';
        $this->fabricLotCollection = Collection::empty();
        $this->highlightFabricLot = 0;

        $this->fabric_lot_name = $obj['vname'] ?? '';;
        $this->fabric_lot_id = $obj['id'] ?? '';;
    }

    public function setFabricLot($name, $id): void
    {
        $this->fabric_lot_name = $name;
        $this->fabric_lot_id = $id;
        $this->getFabricLotList();
    }

    #[On('refresh-fabric-lot')]
    public function refreshFabricLot($v): void
    {
        $this->fabric_lot_id = $v['id'];
        $this->fabric_lot_name = $v['name'];
        $this->fabricLotTyped = false;

    }

    public function getFabricLotList(): void
    {
        $this->fabricLotCollection = $this->fabric_lot_name ? FabricLot::search(trim($this->fabric_lot_name))
            ->get() : FabricLot::all();
    }
    //
    // Colour name
    //

    public $colour_id = '';
    public $colour_name = '';
    public Collection $colourCollection;
    public $highlightColour = 0;
    public $colourTyped = false;

    public function decrementColour(): void
    {
        if ($this->highlightColour === 0) {
            $this->highlightColour = count($this->colourCollection) - 1;
            return;
        }
        $this->highlightColour--;
    }

    public function incrementColour(): void
    {
        if ($this->highlightColour === count($this->colourCollection) - 1) {
            $this->highlightColour = 0;
            return;
        }
        $this->highlightColour++;
    }

    public function enterColour(): void
    {
        $obj = $this->colourCollection[$this->highlightColour] ?? null;

        $this->colour_name = '';
        $this->colourCollection = Collection::empty();
        $this->highlightColour = 0;

        $this->colour_name = $obj['vname'] ?? '';;
        $this->colour_id = $obj['id'] ?? '';;
    }

    public function setColour($name, $id): void
    {
        $this->colour_name = $name;
        $this->colour_id = $id;
        $this->getColourList();
    }

    #[On('refresh-colour')]
    public function refreshColour($v): void
    {
        $this->colour_id = $v['id'];
        $this->colour_name = $v['name'];
        $this->colourTyped = false;
    }

    public function getColourList(): void
    {
        $this->colourCollection = $this->colour_name ? Colour::search(trim($this->colour_name))
            ->get() : Colour::all();
    }

    //
    // Size name
    //

    public $size_id = '';
    public $size_name = '';
    public Collection $sizeCollection;
    public $highlightSize = 0;
    public $sizeTyped = false;

    public function decrementSize(): void
    {
        if ($this->highlightSize === 0) {
            $this->highlightSize = count($this->sizeCollection) - 1;
            return;
        }
        $this->highlightSize--;
    }

    public function incrementSize(): void
    {
        if ($this->highlightSize === count($this->sizeCollection) - 1) {
            $this->highlightSize = 0;
            return;
        }
        $this->highlightSize++;
    }

    public function enterSize(): void
    {
        $obj = $this->sizeCollection[$this->highlightSize] ?? null;

        $this->size_name = '';
        $this->sizeCollection = Collection::empty();
        $this->highlightSize = 0;

        $this->size_name = $obj['vname'] ?? '';;
        $this->size_id = $obj['id'] ?? '';;
    }

    public function setSize($name, $id): void
    {
        $this->size_name = $name;
        $this->size_id = $id;
        $this->getSizeList();
    }

    #[On('refresh-size')]
    public function refreshSize($v): void
    {
        $this->size_id = $v['id'];
        $this->size_name = $v['name'];
        $this->sizeTyped = false;
    }

    public function getSizeList(): void
    {
        $this->sizeCollection = $this->size_name ? Size::search(trim($this->size_name))
            ->get() : Size::all();
    }

    //
    // properties
    //

    public string $vid = '';
    public string $vno = '';
    public string $vdate = '';
    public mixed $total_qty = 0;
    public string $itemIndex = "";
    public $itemList = [];
    public mixed $qty;

    //
    // mount
    //

    public function mount($id): void
    {
        $this->vno = Jobcard::nextNo();
        $this->vdate = Carbon::parse(Carbon::now())->format('Y-m-d');

        if ($id != 0) {

            $obj = Jobcard::find($id);
            $this->vid = $obj->id;
            $this->vno = $obj->vno;
            $this->vdate = $obj->vdate;
            $this->order_id = $obj->order_id;
            $this->order_no = $obj->order->vname;
            $this->style_id = $obj->style_id;
            $this->style_name = $obj->style->vname;
            $this->total_qty = $obj->total_qty;

            $data = DB::table('jobcard_items')
                ->select('jobcard_items.*',
                    'fabric_lots.vname as fabric_lot_name',
                    'colours.vname as colour_name',
                    'sizes.vname as size_name'
                )
                ->join('fabric_lots', 'fabric_lots.id', '=', 'jobcard_items.fabric_lot_id')
                ->join('colours', 'colours.id', '=', 'jobcard_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'jobcard_items.size_id')
                ->where('jobcard_id', '=', $id)
                ->get()
                ->transform(function ($data) {
                    return [
                        'jobcard_item_id' => $data->id,
                        'fabric_lot_name' => $data->fabric_lot_name,
                        'fabric_lot_id' => $data->fabric_lot_id,
                        'colour_name' => $data->colour_name,
                        'colour_id' => $data->colour_id,
                        'size_name' => $data->size_name,
                        'size_id' => $data->size_id,
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
                    'fabric_lot_name' => $this->fabric_lot_name,
                    'fabric_lot_id' => $this->fabric_lot_id,
                    'colour_id' => $this->colour_id,
                    'colour_name' => $this->colour_name,
                    'size_id' => $this->size_id,
                    'size_name' => $this->size_name,
                    'qty' => $this->qty,
                ];
            }
        } else {
            $this->itemList[$this->itemIndex] = [
                'fabric_lot_name' => $this->fabric_lot_name,
                'fabric_lot_id' => $this->fabric_lot_id,
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
        $this->fabric_lot_name = '';
        $this->fabric_lot_id = '';
        $this->colour_name = '';
        $this->colour_id = '';
        $this->size_name = '';
        $this->size_id = '';
        $this->qty = '';
        $this->calculateTotal();
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;

        $items = $this->itemList[$index];
        $this->fabric_lot_name = $items['fabric_lot_name'];
        $this->fabric_lot_id = $items['fabric_lot_id'];
        $this->colour_name = $items['colour_name'];
        $this->colour_id = $items['colour_id'];
        $this->size_name = $items['size_name'];
        $this->size_id = $items['size_id'];
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

                $obj = Jobcard::create([
                    'vno' => $this->vno,
                    'vdate' => $this->vdate,
                    'order_id' => $this->order_id,
                    'style_id' => $this->style_id,
                    'total_qty' => $this->total_qty,
                    'active_id' => '1',
                    'user_id' => \Auth::id(),
                ]);
                $this->saveItem($obj->id);

                $message = "Saved";

            } else {
                $obj = Jobcard::find($this->vid);
                $obj->vno = $this->vno;
                $obj->vdate = $this->vdate;
                $obj->order_id = $this->order_id;
                $obj->style_id = $this->style_id;
                $obj->total_qty = $this->total_qty;
                $obj->active_id = '1';
                $obj->user_id = \Auth::id();
                $obj->save();

                DB::table('jobcard_items')->where('jobcard_id', '=', $obj->id)->delete();
                $this->saveItem($obj->id);
                $message = "Updated";
            }
            $this->getRoute();
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
        foreach ($this->itemList as $sub) {
            JobcardItem::create([
                'jobcard_id' => $id,
                'fabric_lot_id' => $sub['fabric_lot_id'],
                'colour_id' => $sub['colour_id'],
                'size_id' => $sub['size_id'],
                'qty' => $sub['qty'],
                'cutting_qty' => '0',
                'pe_out_qty' => '0',
                'pe_in_qty' => '0',
                'se_out_qty' => '0',
                'se_in_qty' => '0',
                'active_id' => '1',
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
        $this->getOrderList();
        $this->getStyleList();
        $this->getFabricLotList();
        $this->getColourList();
        $this->getSizeList();

        return view('livewire.erp.production.jobcard.upsert');
    }
}
