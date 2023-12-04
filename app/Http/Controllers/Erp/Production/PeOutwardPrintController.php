<?php

namespace App\Http\Controllers\Erp\Production;

use App\Http\Controllers\Controller;
use App\Models\Erp\Production\PeOutward;
use App\Models\Master\Contact;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeOutwardPrintController extends Controller
{
    public function __invoke($vid)
    {
        if($vid != ''){
            $peout = PeOutward::select(
                'pe_outwards.*',
                'jobcards.vno as jobcard_no',
                'orders.vname as order_name',
                'styles.vname as style_name'
            )
                ->join('jobcards', 'jobcards.id', '=', 'pe_outwards.jobcard_id')
                ->join('orders', 'orders.id', '=', 'jobcards.order_id')
                ->join('styles', 'styles.id', '=', 'jobcards.style_id')
                ->where('pe_outwards.id', '=', $vid)
                ->get()->firstOrFail();


            $contact = Contact::printDetails($peout->contact_id);

            $data = DB::table('pe_outward_items')
                ->select(
                    'pe_outward_items.*',
                    'cuttings.vno as cutting_no',
                    'colours.vname as colour_name',
                    'sizes.vname as size_name'
                )
                ->join('cutting_items', 'cutting_items.id', '=', 'pe_outward_items.cutting_item_id')
                ->join('cuttings', 'cuttings.id', '=', 'cutting_items.cutting_id')
                ->join('colours', 'colours.id', '=', 'cutting_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'cutting_items.size_id')
                ->where('pe_outward_id', '=', $vid)
                ->get()
                ->transform(function ($data) {
                    return [
                        'jobcard_item_id' => $data->jobcard_item_id,
                        'cutting_item_id' => $data->cutting_item_id,
                        'cutting_no' => $data->cutting_no,
                        'colour_id' => $data->colour_id,
                        'colour_name' => $data->colour_name,
                        'size_id' => $data->size_id,
                        'size_name' => $data->size_name,
                        'qty' => $data->qty,
                    ];
                });

            $peoutItem  = $data;

            Pdf::setOption(['dpi' => 150, 'defaultPaperSize'=>'a5', 'defaultFont' => 'sans-serif']);
            $customPaper = array(0,0,419.58,595.35);

            $pdf = PDF::loadView('pdf.pe-dc',[
                'obj' => $peout,
                'list' => $peoutItem,
                'contact' => $contact
            ])->setPaper($customPaper, 'landscape');


            $pdf->render();

            return $pdf->stream();

        }
        return null;
    }
}
