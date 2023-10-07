<?php

namespace App\Livewire\Controls\Items\Erp\Production;

use App\Livewire\Controls\Items\Common\ColourItem;
use App\Livewire\Controls\Items\Common\SizeItem;
use App\Livewire\Erp\Production\Cutting\Upsert;
use App\Livewire\Trait\ItemLookupAbstract;
use App\Models\Erp\Jobcard;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;

class JobcardItem extends ItemLookupAbstract
{
    #[On('refresh-with-job')]
    public function refreshObj($v): void
    {
        $this->id = $v['id'];
        $this->getList();
    }


    public function dispatchObj(): void
    {
        $this->dispatch('refresh-jobcard', ['id' => $this->id, 'name' => $this->searches]);
    }

    public function sendItem($colour_name, $colour_id, $size_name, $size_id, $qty)
    {
        $this->dispatch('refresh-cutting-jobcard', [
            'colour_id' => $colour_id, 'colour_name' => $colour_name,
            'size_id' => $colour_id, 'size_name' => $size_name,
            'qty' => $qty])->to(Upsert::class);


        $this->dispatch('refresh-colour-item', ['id' => $colour_id, 'name' => $colour_name])->to(ColourItem::class);
        $this->dispatch('refresh-size-item', ['id' => $size_id, 'name' => $size_name])->to(SizeItem::class);
    }

    public function getList(): void
    {
        if ($this->id) {
            $data = DB::table('jobcard_items')->where('jobcard_id', '=', $this->id)
                ->join('jobcards', 'jobcards.id', '=', 'jobcard_items.jobcard_id')
                ->join('colours', 'colours.id', '=', 'jobcard_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'jobcard_items.size_id')
                ->select('jobcard_items.*', 'jobcards.vno as vno', 'colours.vname as colour_name', 'sizes.vname as size_name')
                ->get()
                ->transform(function ($data) {
                    return [
                        'jobcard_items_id' => $data->id,
                        'jobcard_id' => $data->jobcard_id,
                        'colour_id' => $data->colour_id,
                        'colour_name' => $data->colour_name,
                        'size_id' => $data->size_id,
                        'size_name' => $data->size_name,
                        'qty' => $data->qty,
                    ];
                });

            $this->list = $data;
        }
    }

    public function render()
    {
        $this->getList();
        return view('livewire.controls.items.erp.production.jobcard-item');
    }
}
