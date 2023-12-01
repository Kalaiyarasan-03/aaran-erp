<?php

namespace App\Livewire\Master\Product;

use App\Livewire\Trait\CommonTrait;
use App\Models\Master\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $product_type;
    public string $units;
    public string $gst_percent;

    public function getSave(): string
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                Product::create([
                    'vname' => Str::ucfirst($this->vname),
                    'product_type' => $this->product_type,
                    'units' => $this->units,
                    'gst_percent' => $this->gst_percent,
                    'active_id' => $this->active_id,
                    'user_id' => Auth::id()
                ]);
                $message = "Saved";

            } else {
                $obj = Product::find($this->vid);
                $obj->vname = Str::ucfirst($this->vname);
                $obj->product_type = $this->product_type;
                $obj->units = $this->units;
                $obj->gst_percent = $this->gst_percent;
                $obj->active_id = $this->active_id;
                $obj->user_id = Auth::id();
                $obj->save();
                $message = "Updated";
            }
            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Product::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->product_type = $obj->product_type;
            $this->units = $obj->units;
            $this->gst_percent = $obj->gst_percent;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        return Product::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender()
    {
        $this->render()->render();
    }

    public function render()
    {
        return view('livewire.master.product.index')->with([
            'list' => $this->getList()
        ]);
    }
}
