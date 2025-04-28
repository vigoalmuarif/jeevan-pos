<?php

namespace App\Http\Controllers\Export\Pdf\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

use function Spatie\LaravelPdf\Support\pdf;

class PermintaanBarangController extends Controller
{
    public function requestOrder(Request $request)
    {
        $requestOrder = $request->noorder;
        $data['company'] = Business::where('id', auth()->user()->current_active_business_id)->first();
        return pdf()
            ->view('exports.pdf.inventory.permintaan_barang.permintaan_barang', $data)
            // $top, $right, $bottom, $left
            ->margins(8, 10, 8, 10)
            ->name('invoice-2023-04-10.pdf');
    }
}
