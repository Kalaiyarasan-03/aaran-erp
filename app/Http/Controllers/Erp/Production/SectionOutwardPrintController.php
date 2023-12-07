<?php

namespace App\Http\Controllers\Erp\Production;

use App\Http\Controllers\Controller;
use App\Models\Erp\Production\PeOutward;
use App\Models\Erp\Production\SectionOutward;
use App\Models\Master\Contact;
use App\Models\Tenant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionOutwardPrintController extends Controller
{
    public function __invoke($vid)
    {
        if($vid != ''){
            $peout = SectionOutward::select(
                'section_outwards.*',
                'jobcards.vno as jobcard_no',
                'orders.vname as order_name',
                'styles.vname as style_name'
            )
                ->join('jobcards', 'jobcards.id', '=', 'section_outwards.jobcard_id')
                ->join('orders', 'orders.id', '=', 'jobcards.order_id')
                ->join('styles', 'styles.id', '=', 'jobcards.style_id')
                ->where('section_outwards.id', '=', $vid)
                ->get()->firstOrFail();


            $contact = Contact::printDetails($peout->contact_id);
            $tenant = Tenant::printDetails(1);

            $data = DB::table('section_outward_items')
                ->select(
                    'section_outward_items.*',
                    'colours.vname as colour_name',
                    'sizes.vname as size_name'
                )
                ->join('colours', 'colours.id', '=', 'section_outward_items.colour_id')
                ->join('sizes', 'sizes.id', '=', 'section_outward_items.size_id')
                ->where('section_outward_id', '=', $vid)
                ->get()
                ->transform(function ($data) {
                    return [
                        'jobcard_item_id' => $data->jobcard_item_id,
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

            $pdf = PDF::loadView('pdf.section-dc',[
                'obj' => $peout,
                'list' => $peoutItem,
                'cmp' => $tenant,
                'contact' => $contact
            ])->setPaper($customPaper, 'landscape');


            $pdf->render();

            return $pdf->stream();

        }
        return null;
    }
}
