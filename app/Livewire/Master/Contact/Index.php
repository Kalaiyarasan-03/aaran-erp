<?php

namespace App\Livewire\Master\Contact;

use App\Livewire\Trait\CommonTrait;
use App\Models\Common\City;
use App\Models\Common\Pincode;
use App\Models\Common\State;
use App\Models\Master\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    use CommonTrait;

    public string $mobile = '';
    public string $whatsapp = '';
    public string $email = '';
    public string $gstin = '';
    public string $address_1 = '';
    public string $address_2 = '';
    public string $city_id = '';
    public string $state_id = '';
    public string $pincode_id = '';
    public string $contact_type = '';


    public $cities;
    public $states;
    public $pincodes;
    public function mount()
    {
        $this->cities = City::all();
        $this->states = State::all();
        $this->pincodes = Pincode::all();
    }

    public function getSave(): string
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                Contact::create([
                    'vname' => Str::ucfirst($this->vname),
                    'mobile' => $this->mobile,
                    'whatsapp' => $this->whatsapp,
                    'email' => $this->email,
                    'gstin' => $this->gstin,
                    'address_1' => $this->address_1,
                    'address_2' => $this->address_2,
                    'city_id' => $this->city_id,
                    'state_id' => $this->state_id,
                    'pincode_id' => $this->pincode_id,
                    'contact_type' => $this->contact_type,
                    'active_id' => $this->active_id,
                    'user_id' => Auth::id(),
                ]);
                $message = "Saved";

            } else {
                $obj = Contact::find($this->vid);
                $obj->vname = Str::ucfirst($this->vname);
                $obj->mobile = $this->mobile;
                $obj->whatsapp = $this->whatsapp;
                $obj->email = $this->email;
                $obj->gstin = $this->gstin;
                $obj->address_1 = $this->address_1;
                $obj->address_2 = $this->address_2;
                $obj->city_id = $this->city_id;
                $obj->state_id = $this->state_id;
                $obj->pincode_id = $this->pincode_id;
                $obj->contact_type = $this->contact_type;
                $obj->active_id = $this->active_id;
                $obj->user_id = Auth::id();
                $obj->save();
                $message = "Updated";
            }
            $this->vname = '';
            $this->mobile = '';
            $this->whatsapp = '';
            $this->email = '';
            $this->gstin = '';
            $this->address_1 = '';
            $this->address_2 = '';
            $this->city_id = '';
            $this->state_id = '';
            $this->pincode_id = '';
            $this->contact_type = '';

            return $message;
        }
        return '';
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Contact::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->mobile = $obj->mobile;
            $this->whatsapp = $obj->whatsapp;
            $this->email = $obj->email;
            $this->gstin = $obj->gstin;
            $this->address_1 = $obj->address_1;
            $this->address_2 = $obj->address_2;
            $this->city_id = $obj->city_id;
            $this->state_id = $obj->state_id;
            $this->pincode_id = $obj->pincode_id;
            $this->contact_type = $obj->contact_type;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        return Contact::search($this->searches)
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
        return view('livewire.master.contact.index')->with([
            'list' => $this->getList()
        ]);
    }
}
