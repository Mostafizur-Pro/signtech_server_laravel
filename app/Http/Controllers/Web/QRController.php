<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        return view('dashboard/settings/qr-generator');
    }

    public function generate(Request $request)
    {
        // Validate input
        $request->validate([
            'model' => 'required|string',
            'type' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'invoice' => 'required|string',
            'date' => 'required|date',
        ]);

        $model = $request->model;
        $type = $request->type;
        $quantity = $request->quantity;
        $invoice = $request->invoice;
        $date = $request->date;

        $qrCodes = [];

        for ($i = 1; $i <= $quantity; $i++) {
            $text = "Model: $model\nType: $type\nInvoice: $invoice\nDate: $date\nSN: $i";

            $qrCodes[] = [
                'model' => $model,
                'type' => $type,
                'invoice' => $invoice,
                'date' => $date,
                'sn' => $i,
                'code' => QrCode::size(150)->generate($text)
            ];
        }

        return view('qr-generator', compact('qrCodes'));
    }
}
