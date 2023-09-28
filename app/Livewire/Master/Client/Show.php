<?php

namespace App\Livewire\Master\Client;

use App\Enums\Active;
use App\Livewire\Trait\CommonTrait;
use App\Models\Master\Biller;
use App\Models\Master\Client;
use App\Models\Master\ClientDetail;
use DB;
use Livewire\Component;

class Show extends Component
{
    use CommonTrait;

    public Client $client;
    public string $mobile='';
    public string $whatsapp='';
    public string $email='';
    public string $gstin = '';
    public string $address_1 = '';
    public string $address_2 = '';
    public string $city = '';
    public string $state = '';
    public string $pincode = '';
    public string $gst_user = '';
    public string $gst_pass = '';
    public string $einvoice_user = '';
    public string $einvoice_pass = '';
    public string $eway_user = '';
    public string $eway_pass = '';
    public string $einvoice_api = '';
    public string $einvoice_api_pass = '';
    public string $eway_api = '';
    public string $eway_api_pass = '';
    public string $acc_email = '';
    public string $acc_email_pass = '';

    public $clientId='';
    public bool $showModal;
    public $modalName;

    public function mount($id)
    {

        $this->clients = Client::all();

        if ($id) {

            $this->clientId = $id;

            $this->client = Client::find($id);

            DB::table('client_details')->where('client_id', '=', $id)
                ->get()
                ->transform(function ($data) {
                    return [
                        $this->vid = $data->id,
                        $this->clientId = $data->client_id,
                        $this->vname = $data->vname,
                        $this->mobile = $data->mobile,
                        $this->whatsapp = $data->whatsapp,
                        $this->email = $data->email,
                        $this->gstin = $data->gstin,
                        $this->address_1 = $data->address_1,
                        $this->address_2 = $data->address_2,
                        $this->city = $data->city,
                        $this->state = $data->state,
                        $this->pincode = $data->pincode,
                        $this->gst_user = $data->gst_user,
                        $this->gst_pass = $data->gst_pass,
                        $this->einvoice_user = $data->einvoice_user,
                        $this->einvoice_pass = $data->einvoice_pass,
                        $this->eway_user = $data->eway_user,
                        $this->eway_pass = $data->eway_pass,
                        $this->einvoice_api = $data->einvoice_api,
                        $this->einvoice_api_pass = $data->einvoice_api_pass,
                        $this->eway_api = $data->eway_api,
                        $this->eway_api_pass = $data->eway_api_pass,
                        $this->acc_email = $data->acc_email,
                        $this->acc_email_pass = $data->acc_email_pass,
                    ];
                });
        }
    }

    public function showDetailModal($v): void
    {
        $this->showModal = true;

        switch ($v) {
            case 'contactDetails':
                $this->modalName = 'contactDetails';
                break;
            case 'address':
                $this->modalName = 'address';
                break;
            case 'gstPass':
                $this->modalName = 'gstPass';
                break;
            case 'einvoice':
                $this->modalName = 'einvoice';
                break;
            case 'eway':
                $this->modalName = 'eway';
                break;
            case 'einvoiceApi':
                $this->modalName = 'einvoiceApi';
                break;
            case 'ewayApi':
                $this->modalName = 'ewayApi';
                break;
            case 'accEmail':
                $this->modalName = 'accEmail';
                break;
        }
    }

    public function upsertDetails(): void
    {
        if ($this->vid) {
            $this->updateClientDetails();
        }
        $this->showModal = false;
    }


    public function updateClientDetails(): void
    {
        $obj = ClientDetail::find($this->vid);
        $obj->vname = $this->vname;
        $obj->mobile = $this->mobile;
        $obj->whatsapp = $this->whatsapp;
        $obj->email = $this->email;
        $obj->gstin = $this->gstin;
        $obj->address_1 = $this->address_1;
        $obj->address_2 = $this->address_2;
        $obj->city = $this->city;
        $obj->state = $this->state;
        $obj->pincode = $this->pincode;
        $obj->gst_user = $this->gst_user;
        $obj->gst_pass = $this->gst_pass;
        $obj->einvoice_user = $this->einvoice_user;
        $obj->einvoice_pass = $this->einvoice_pass;
        $obj->eway_user = $this->eway_user;
        $obj->eway_pass = $this->eway_pass;
        $obj->einvoice_api = $this->einvoice_api;
        $obj->einvoice_api_pass = $this->einvoice_api_pass;
        $obj->eway_api = $this->eway_api;
        $obj->eway_api_pass = $this->eway_api_pass;
        $obj->acc_email = $this->acc_email;
        $obj->acc_email_pass = $this->acc_email_pass;
        $obj->save();
    }


    public bool $billPlanModal;
    public $clients;

    public function showBillPlan(): void
    {

        $this->billPlanModal = true;
    }

    public string $companyx;
    public string $modex;

    public function createBillPlan(): void
    {
        if ($this->clientId) {
            Biller::create([
                'client_id' => $this->clientId,
                'vname' => $this->companyx,
                'mode' => $this->modex,
                'active_id' => Active::ACTIVE->value
            ]);
        }

        $this->billPlanModal = false;
        $this->render();

    }

    public function deleteBillPlan($id): void
    {
        if ($id) {
            $obj = Biller::find($id);
            if ($obj) {
                $obj->delete();
            }
        }
        $this->render();
    }


    public function getBilling()
    {
        return Biller::where('client_id', '=', $this->clientId)->get();
    }


    public function redirectTo(): void
    {
        redirect()->to(route('clients'));
    }

    public function render()
    {
        return view('livewire.master.client.show')->with([ 'list' => $this->getBilling()]);
    }
}
