<?php

namespace App\Livewire\Master\Tenant;

use App\Livewire\Trait\CommonTrait;
use App\Models\Common\City;
use App\Models\Common\Pincode;
use App\Models\Common\State;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $display_name = '';
    public string $address_1 = '';
    public string $address_2 = '';
    public string $city_id = '';
    public string $state_id = '';
    public string $pincode_id = '';

    public string $mobile = '';
    public string $whatsapp = '';
    public string $landline = '';
    public string $gstin = '';
    public string $pan = '';
    public string $email = '';
    public string $website = '';

    public $cities;
    public $states;
    public $pincodes;

    public function mount()
    {
        $this->cities = City::all();
        $this->states = State::all();
        $this->pincodes = Pincode::all();
    }

    public function getSave(): void
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                Tenant::create([
                    'vname' => Str::ucfirst($this->vname),
                    'display_name' => Str::ucfirst($this->display_name),
                    'address_1' => $this->address_1,
                    'address_2' => $this->address_2,
                    'city_id' => $this->city_id,
                    'state_id' => $this->state_id,
                    'pincode_id' => $this->pincode_id,
                    'mobile' => $this->mobile,
                    'whatsapp' => $this->whatsapp,
                    'landline' => $this->landline,
                    'gstin' => $this->gstin,
                    'pan' => $this->pan,
                    'email' => $this->email,
                    'website' => $this->website,
                    'active_id' => $this->active_id,
                ]);

            } else {
                $obj = Tenant::find($this->vid);
                $obj->vname = Str::ucfirst($this->vname);
                $obj->display_name = Str::ucfirst($this->display_name);
                $obj->address_1 = $this->address_1;
                $obj->address_2 = $this->address_2;
                $obj->city_id = $this->city_id;
                $obj->state_id = $this->state_id;
                $obj->pincode_id = $this->pincode_id;
                $obj->mobile = $this->mobile;
                $obj->whatsapp = $this->whatsapp;
                $obj->landline = $this->landline;
                $obj->gstin = $this->gstin;
                $obj->pan = $this->pan;
                $obj->email = $this->email;
                $obj->website = $this->website;
                $obj->active_id = $this->active_id;
                $obj->save();
            }
            $this->vname = '';
            $this->display_name = '';
            $this->address_1 = '';
            $this->address_2 = '';
            $this->city_id = '';
            $this->state_id = '';
            $this->pincode_id = '';
            $this->mobile = '';
            $this->whatsapp = '';
            $this->landline = '';
            $this->gstin = '';
            $this->pan = '';
            $this->email = '';
            $this->website = '';
        }
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Tenant::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->display_name = $obj->display_name;
            $this->address_1 = $obj->address_1;
            $this->address_2 = $obj->address_2;
            $this->city_id = $obj->city_id;
            $this->state_id = $obj->state_id;
            $this->pincode_id = $obj->pincode_id;
            $this->mobile = $obj->mobile;
            $this->whatsapp = $obj->whatsapp;
            $this->landline = $obj->landline;
            $this->gstin = $obj->gstin;
            $this->pan = $obj->pan;
            $this->email = $obj->email;
            $this->website = $obj->website;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        return Tenant::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render()->render();
    }

    public function render()
    {
        return view('livewire.master.tenant.index')->with([
            'list' => $this->getList()
        ]);
    }
}
