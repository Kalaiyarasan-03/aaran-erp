<?php

namespace App\Livewire\Admin\Creditbook;

use App\Livewire\Trait\CommonTrait;
use App\Models\Admin\CreditBook;
use App\Models\Admin\CreditBookItem;
use Livewire\Component;
use DB;

class Item extends Component
{
    use CommonTrait;

    public $vdate = '';
    public string $purpose = '';
    public $credit;
    public $debit;
    public $interest;
    public CreditBook $creditBook;
    public $closing;

    public function mount($id)
    {
        $this->creditBook = CreditBook::find($id);
    }

    public function getSave(): string
    {
        if ($this->credit == '') {
            $this->credit = 0;
        }
        if ($this->debit == '') {
            $this->debit = 0;
        }

        if ($this->interest == '') {
            $this->interest = 0;
        }

        if ($this->vid == "") {
            CreditBookItem::create([
                'credit_book_id' => $this->creditBook->id,
                'vdate' => $this->vdate,
                'purpose' => $this->purpose,
                'credit' => $this->credit,
                'debit' => $this->debit,
                'interest' => $this->interest,
                'active_id' => $this->active_id,
                'user_id' => \Auth::id(),
            ]);
            $message = "Saved";
        } else {
            $obj = CreditBookItem::find($this->vid);
            $obj->credit_book_id = $this->creditBook->id;
            $obj->vdate = $this->vdate;
            $obj->purpose = $this->purpose;
            $obj->credit = $this->credit;
            $obj->debit = $this->debit;
            $obj->interest = $this->interest;
            $obj->active_id = $this->active_id ?: '0';
            $obj->user_id = \Auth::id();
            $obj->save();
            $message = "Updated";
        }
        $this->updateMaster();
        return $message;
    }

    public function updateMaster()
    {
        $XCredit = DB::table('credit_book_items')
            ->where('credit_book_id', '=', $this->creditBook->id)
            ->sum('credit');
        $XDebit = DB::table('credit_book_items')
            ->where('credit_book_id', '=', $this->creditBook->id)
            ->sum('debit');
        $this->creditBook->closing = $XCredit - $XDebit;
        $this->creditBook->save();
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = CreditBookItem::find($id);
            $this->vid = $obj->id;
            $this->vdate = $obj->vdate;
            $this->purpose = $obj->purpose;
            $this->credit = $obj->credit;
            $this->debit = $obj->debit;
            $this->interest = $obj->interest;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    public function getList()
    {
        $this->sortField = 'id';

        return CreditBookItem::search($this->searches)
            ->where('credit_book_id', '=', $this->creditBook->id)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function reRender(): void
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.admin.creditbook.item')->with([
            'list' => $this->getList()
        ]);
    }
}
