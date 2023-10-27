<?php

namespace App\Livewire\Erp\Order;

use App\Models\Erp\Order;
use App\Models\Erp\Production\CuttingItem;
use App\Models\Erp\Production\Jobcard;
use App\Models\Erp\Production\JobcardItem;
use App\Models\Erp\Production\PeInwardItem;
use App\Models\Erp\Production\PeOutwardItem;
use App\Models\Erp\Production\SectionInwardItem;
use App\Models\Erp\Production\SectionOutwardItem;
use Livewire\Component;

class JobDetails extends Component
{
    public $jobId;
    public Order $order;
    public Jobcard $jobcard;

    public function mount($id)
    {
        $this->jobId = $id;
        $this->jobcard = Jobcard::find($id);
    }

    public $jobDetails;

    public function getJobDetails(): void
    {
        $this->jobDetails = JobcardItem::select([
            'jobcard_items.*',
            'fabric_lots.vname as fabric_lot_name',
            'colours.vname as colour_name',
            'sizes.vname as size_name',
        ])
            ->join('fabric_lots', 'fabric_lots.id', '=', 'jobcard_items.fabric_lot_id')
            ->join('colours', 'colours.id', '=', 'jobcard_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'jobcard_items.size_id')
            ->where('jobcard_id', '=', $this->jobcard->id)
            ->get();

    }

    public $cuttingDetails;

    public function getCuttingDetails(): void
    {
        $this->cuttingDetails = CuttingItem::select([
            'cutting_items.*',
            'fabric_lots.vname as fabric_lot_name',
            'colours.vname as colour_name',
            'sizes.vname as size_name',
            'cuttings.vno as cutting_no',
            'cuttings.vdate as cutting_date',
        ])
            ->join('cuttings', 'cuttings.id', '=', 'cutting_items.cutting_id')
            ->join('fabric_lots', 'fabric_lots.id', '=', 'cutting_items.fabric_lot_id')
            ->join('colours', 'colours.id', '=', 'cutting_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'cutting_items.size_id')
            ->where('cuttings.jobcard_id', '=', $this->jobcard->id)
            ->get();

    }

    public $peOutDetails;

    public function getPeOutDetails(): void
    {
        $this->peOutDetails = PeOutwardItem::select([
            'pe_outward_items.*',
            'colours.vname as colour_name',
            'sizes.vname as size_name',
            'pe_outwards.vno as pe_out_no',
            'pe_outwards.vdate as pe_out_date',
        ])
            ->join('pe_outwards', 'pe_outwards.id', '=', 'pe_outward_items.pe_outward_id')
            ->join('colours', 'colours.id', '=', 'pe_outward_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'pe_outward_items.size_id')
            ->where('pe_outwards.jobcard_id', '=', $this->jobcard->id)
            ->get();

    }

    public $peInDetails;

    public function getPeInDetails(): void
    {
        $this->peInDetails = PeInwardItem::select([
            'pe_inward_items.*',
            'colours.vname as colour_name',
            'sizes.vname as size_name',
            'pe_inwards.vno as pe_in_no',
            'pe_inwards.vdate as pe_in_date',
        ])
            ->join('pe_inwards', 'pe_inwards.id', '=', 'pe_inward_items.pe_inward_id')
            ->join('colours', 'colours.id', '=', 'pe_inward_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'pe_inward_items.size_id')
            ->where('pe_inwards.jobcard_id', '=', $this->jobcard->id)
            ->get();

    }

    public $seOutDetails;

    public function getSeOutDetails(): void
    {
        $this->seOutDetails = SectionOutwardItem::select([
            'section_outward_items.*',
            'colours.vname as colour_name',
            'sizes.vname as size_name',
            'section_outwards.vno as se_out_no',
            'section_outwards.vdate as se_out_date',
        ])
            ->join('section_outwards', 'section_outwards.id', '=', 'section_outward_items.section_outward_id')
            ->join('colours', 'colours.id', '=', 'section_outward_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'section_outward_items.size_id')
            ->where('section_outwards.jobcard_id', '=', $this->jobcard->id)
            ->get();

    }

    public $seInDetails;

    public function getSeInDetails(): void
    {
        $this->seInDetails = SectionInwardItem::select([
            'section_inward_items.*',
            'colours.vname as colour_name',
            'sizes.vname as size_name',
            'section_inwards.vno as se_in_no',
            'section_inwards.vdate as se_in_date',
        ])
            ->join('section_inwards', 'section_inwards.id', '=', 'section_inward_items.section_inward_id')
            ->join('colours', 'colours.id', '=', 'section_inward_items.colour_id')
            ->join('sizes', 'sizes.id', '=', 'section_inward_items.size_id')
            ->where('section_inwards.jobcard_id', '=', $this->jobcard->id)
            ->get();

    }


    public function render()
    {
        $this->getJobDetails();
        $this->getCuttingDetails();
        $this->getPeOutDetails();
        $this->getPeInDetails();
        $this->getSeOutDetails();
        $this->getSeInDetails();

        return view('livewire.erp.order.job-details');
    }
}
