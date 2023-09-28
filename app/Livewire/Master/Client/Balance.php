<?php

namespace App\Livewire\Master\Client;

use App\Livewire\Trait\CommonTrait;
use App\Models\Master\BankBalance;
use App\Models\Master\ClientBank;
use Carbon\Carbon;
use Livewire\Component;

class Balance extends Component
{
    use CommonTrait;

    public string $client_bank_id = '';
    public $cdate;
    public mixed $balance = 0;
    public $clients;

    public function mount()
    {
        $this->cdate = Carbon::now();
        $this->clients = ClientBank::where('active_id','=','1')->get();
    }

    public function getSave(): string
    {
        if ($this->client_bank_id != '' or $this->acno != '' or $this->ifsc != '') {
            if ($this->vid !== "") {
                $obj = BankBalance::find($this->vid);
                $obj->client_bank_id = $this->client_bank_id;
                $obj->cdate = $this->cdate;
                $obj->balance = $this->balance;
                $obj->user_id = \Auth::id();
                $obj->save();
                $message = "Updated";
            }

            $this->client_bank_id = '';
            $this->balance = '';

            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = BankBalance::find($id);
            $this->vid = $obj->id;
            $this->client_bank_id = $obj->client_bank_id;
            $this->cdate = $obj->cdate;
            $this->balance = $obj->balance;
            return $obj;
        }
        return null;
    }

    public function generate(): void
    {
        $gstClient = ClientBank::where('active_id', '=', '1')->get();

        if ($this->cdate == '') {
            $this->cdate = now();
        }

        foreach ($gstClient as $obj) {

            $v = BankBalance::where('client_bank_id', '=', $obj->id)
                ->Where('cdate', '=', $this->cdate)
                ->get();

            if ($v->count() == 0) {
                BankBalance::create([
                    'client_bank_id' => $obj->id,
                    'cdate' => $this->cdate,
                    'balance' => 0,
                    'user_id' => \Auth::id()
                ]);
            }
        }
    }

    public function getList()
    {
        $this->sortField = 'client_bank_id';


        return BankBalance::search($this->searches)
            ->whereDate('cdate', '=', $this->cdate)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(){
        $this->render();
    }

    public function render()
    {
        return view('livewire.master.client.balance')->with([
            'list' => $this->getList()
        ]);
    }
}
