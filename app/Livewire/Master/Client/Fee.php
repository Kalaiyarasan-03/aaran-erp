<?php

namespace App\Livewire\Master\Client;

use App\Enums\Months;
use App\Enums\Status;
use App\Enums\Years;
use App\Livewire\Trait\CommonTrait;
use App\Models\Master\Client;
use App\Models\Master\ClientFee;
use Livewire\Component;

class Fee extends Component
{
    use CommonTrait;

    public string $month;
    public string $year;
    public string $invoice_no;
    public mixed $invoice_date;
    public mixed $taxable;
    public mixed $gst;
    public mixed $amount;
    public mixed $receipt;
    public mixed $receipt_date;
    public string $receipt_ref;
    public string $status_id;

    public function mount()
    {
        $this->month = Months::JUNE->value;
        $this->year = Years::AY_2023->value;
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = ClientFee::find($id);
            $this->vid = $obj->id;
            $this->client_id = $obj->client_id;
            $this->month = $obj->month;
            $this->year = $obj->year;
            $this->invoice_no = $obj->invoice_no;
            $this->invoice_date = $obj->invoice_date;
            $this->taxable = $obj->taxable;
            $this->gst = $obj->gst;
            $this->amount = $obj->amount;
            $this->receipt = $obj->receipt;
            $this->receipt_date = $obj->receipt_date;
            $this->receipt_ref = $obj->receipt_ref;
            $this->active_id = $obj->active_id;
        }
    }

    public function getSave(): string
    {
        if ($this->vid) {
            $obj = ClientFee::find($this->vid);
            $obj->invoice_no = $this->invoice_no;
            $obj->invoice_date = $this->invoice_date;

            $obj->taxable = $this->taxable;
            $obj->gst = $this->gst;
            $obj->amount = $this->taxable + $this->gst;

            $obj->receipt = $this->receipt;
            $obj->receipt_date = $this->receipt_date;

            $total = ($this->taxable + $this->gst) - $this->receipt;

            if ($total == 0) {
                $obj->status_id = Status::RECEIVED->value;
            } else {
                $obj->status_id = Status::PENDING->value;
            }
            $obj->active_id = $this->active_id ?: '0';
            $obj->user_id = \Auth::id();
            $obj->save();
        }

        $this->gstno = '';
        $this->username = '';
        $this->password = '';
        $this->client = '';
        return 'Updated';
    }

    public function generate(): void
    {
        $gstClient = Client::where('payable', '=', '1')
            ->where('active_id', '=', '1')->get();

        foreach ($gstClient as $obj) {
            $v = ClientFee::where('client_id', '=', $obj->id)
                ->Where('month', '=', $this->month)
                ->Where('year', '=', $this->year)
                ->get();
            if ($v->count() == 0) {
                ClientFee::create([
                    'client_id' => $obj->id,
                    'month' => $this->month,
                    'year' => $this->year,
                    'invoice_no' => '',
                    'invoice_date' => '',
                    'taxable' => '0',
                    'gst' => '0',
                    'amount' => '0',
                    'receipt' => '0',
                    'receipt_date' => '',
                    'receipt_ref' => '',
                    'active_id' => '1',
                    'status_id' => '1',
                    'user_id' => \Auth::id()
                ]);
            }
        }
    }

    public function getList()
    {
        $this->sortField = 'client_id';

        return ClientFee::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->where('month', '=', $this->month)
            ->where('year', '=', $this->year)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    public function reRender(){
        $this->render();
    }

    public function render()
    {
        return view('livewire.master.client.fee')->with([
            'list' => $this->getList()
        ]);
    }
}
