<?php

namespace App\Livewire\Master\Client;

use App\Livewire\Trait\CommonTrait;
use App\Models\Master\Client;
use App\Models\Master\ClientBank;
use Livewire\Component;

class Bank extends Component
{
    use CommonTrait;

    public string $client_id = '';
    public string $acno = '';
    public string $ifsc = '';
    public string $bank = '';
    public string $branch = '';
    public string $customer_id = '';
    public string $customer_id2 = '';
    public string $pks = '';
    public string $trs = '';
    public string $profileps = '';
    public string $mobile = '';
    public string $email = '';
    public string $dvcatm = '';

    public $clients;

    public function mount()
    {
        $this->clients = Client::all();
    }

    public function getSave(): string
    {
        if ($this->client_id != '' or $this->acno != '' or $this->ifsc != '') {

            if ($this->vid == "") {
                $client = ClientBank::create([
                    'client_id' => $this->client_id,
                    'vname' => \Str::upper($this->vname),
                    'acno' => $this->acno,
                    'ifsc' => \Str::upper($this->ifsc),
                    'bank' => \Str::upper($this->bank),
                    'branch' => \Str::upper($this->branch),
                    'customer_id' => $this->customer_id,
                    'customer_id2' => $this->customer_id2,
                    'pks' => $this->pks,
                    'trs' => $this->trs,
                    'profileps' => $this->profileps,
                    'mobile' => $this->mobile,
                    'email' => $this->email,
                    'dvcatm' => $this->dvcatm,
                    'active_id' => $this->active_id,
                    'user_id' => \Auth::id(),
                ]);
                $message = "Saved";

            } else {
                $obj = ClientBank::find($this->vid);
                $obj->client_id = $this->client_id;
                $obj->vname = \Str::upper($this->vname);
                $obj->acno = $this->acno;
                $obj->ifsc = \Str::upper($this->ifsc);
                $obj->bank = \Str::upper($this->bank);
                $obj->branch = \Str::upper($this->branch);
                $obj->customer_id = $this->customer_id;
                $obj->customer_id2 = $this->customer_id2;
                $obj->pks = $this->pks;
                $obj->trs = $this->trs;
                $obj->profileps = $this->profileps;
                $obj->mobile = $this->mobile;
                $obj->email = $this->email;
                $obj->dvcatm = $this->dvcatm;
                $obj->active_id = $this->active_id;
                $obj->user_id = \Auth::id();
                $obj->save();
                $message = "Updated";
            }
            $this->acno = '';
            $this->ifsc = '';
            $this->bank = '';
            $this->branch = '';
            $this->customer_id = '';
            $this->customer_id2 = '';
            $this->pks = '';
            $this->trs = '';
            $this->profileps = '';
            $this->mobile = '';
            $this->email = '';
            $this->dvcatm = '';
            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = ClientBank::find($id);
            $this->vid = $obj->id;
            $this->client_id = $obj->client_id;
            $this->vname = $obj->vname;
            $this->acno = $obj->acno;
            $this->ifsc = $obj->ifsc;
            $this->bank = $obj->bank;
            $this->branch = $obj->branch;
            $this->customer_id = $obj->customer_id;
            $this->customer_id2 = $obj->customer_id2;
            $this->pks = $obj->pks;
            $this->trs = $obj->trs;
            $this->profileps = $obj->profileps;
            $this->mobile = $obj->mobile;
            $this->email = $obj->email;
            $this->dvcatm = $obj->dvcatm;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'client_id';

        return ClientBank::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender()
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.master.client.bank')->with([
            'list' => $this->getList()
        ]);
    }
}
