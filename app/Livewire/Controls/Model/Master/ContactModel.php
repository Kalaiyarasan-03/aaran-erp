<?php

namespace App\Livewire\Controls\Model\Master;

use App\Models\Master\Contact;
use Livewire\Component;

class ContactModel extends Component
{
    public bool $showModel = false;

    public string $vname = "";
    public string $contact_person = '';
    public string $mobile = '';
    public string $whatsapp = '';
    public string $landline = '';
    public string $gstin = '';
    public string $pan = '';
    public string $email = '';
    public string $website = '';
    public string $address_1 = '';
    public string $address_2 = '';
    public string $city_id = '';
    public string $state_id = '';
    public string $pincode_id = '';
    public string $active_id = '1';

    public function mount($name)
    {
        $this->vname = $name;
    }

    public function save()
    {
        if ($this->vname != '') {
            $obj = Contact::create([
                'vname' => $this->vname,
                'contact_person' => $this->contact_person,
                'mobile' => $this->mobile,
                'whatsapp' => $this->whatsapp,
                'landline' => $this->landline,
                'gstin' => $this->gstin,
                'pan' => $this->pan,
                'email' => $this->email,
                'website' => $this->website,
                'address_1' => $this->address_1,
                'address_2' => $this->address_2,
                'city_id' => $this->city_id,
                'state_id' => $this->state_id,
                'pincode_id' => $this->pincode_id,
                'active_id' => '1',
                'user_id' => \Auth::id()
            ]);
            $this->dispatch('refresh-contact-item', ['name' => $this->vname, 'id' => $obj->id]);
            $this->dispatch('refresh-contact', ['name' => $this->vname, 'id' => $obj->id]);
            $this->clearAll();
        }
    }

    public function clearAll()
    {
        $this->showModel = false;
        $this->vname = "";
        $this->contact_person = "";
        $this->mobile = "";
        $this->whatsapp = "";
        $this->landline = "";
        $this->gstin = "";
        $this->pan = "";
        $this->email = "";
        $this->website = "";
        $this->address_1 = "";
        $this->address_2 = "";
        $this->city_id = "";
        $this->state_id = "";
        $this->pincode_id = "";
        $this->active_id = "1";
    }

    public function render()
    {
        return view('livewire.controls.model.master.contact-model');
    }
}
