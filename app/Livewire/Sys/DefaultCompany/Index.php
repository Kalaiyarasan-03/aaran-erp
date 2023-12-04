<?php

namespace App\Livewire\Sys\DefaultCompany;

use App\Livewire\Trait\CommonTrait;
use App\Models\Sys\DefaultCompany;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public Collection $tenants;

    public bool $showCompanies = false;
    public tenant $tenant;
    public string $company = '';

    public function getDefaultCompany(): void
    {
        $defaultCompany = DefaultCompany::find(1);

        if ($defaultCompany) {
            if ($defaultCompany->tenant_id != 0) {
                $this->tenant = Tenant::find($defaultCompany->tenant_id);
                $this->company = $this->tenant->vname;
                $this->showCompanies = false;
            } else {
                $this->company = '';
                $this->showCompanies = true;
                $this->getAllCompanies();
            }
        } else {
            $this->showCompanies = true;
            $this->getAllCompanies();
        }
    }

    public
    function getAllCompanies(): void
    {
        $this->tenants = Tenant::all();
        $this->showCompanies = true;
    }

    public
    function setDefault($id): void
    {
        $obj = DefaultCompany::find(1);
        if ($obj) {
            $obj->tenant_id = $id;
            $obj->save();
        } else {
            DefaultCompany::create([
                'tenant_id' => $id,
                'acyear' => '1'
            ]);
        }
        $this->showCompanies = false;
    }

    public
    function switchCompany(): void
    {
        $obj = DefaultCompany::find(1);
        $obj->tenant_id = 0;
        $obj->save();

        $this->showCompanies = true;
    }


    public
    function render()
    {
        $this->getDefaultCompany();

        return view('livewire.sys.default-company.index');
    }
}
