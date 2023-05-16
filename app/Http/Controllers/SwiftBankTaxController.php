<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwiftBankTaxRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class SwiftBankTaxController extends Controller
{
    public function draw() {
        return view("swift-bank-tax-office");
    }

    public function index(SwiftBankTaxRequest $request)
    {
        try {
            $data = $request->validated();

            $document = new Mpdf();

            $documentFileName = $data["fileName"] . ".pdf";

            $html = new HtmlController();

            $templateData = [];

            $document->WriteHTML($html->getHtml("swift-bank-tax-office", $templateData));

            Storage::disk('public')->put('/PDFs/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));

            return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
                "token" => $data["token"],
                "bucket_name" => "nalog",
                "dir_name" => "test",
                "is_public" => true,
                "files_data" => [
                    Storage::disk('public')->url('/PDFs/' . $documentFileName) => Hash::make(date('Y-m-d H:i:s'))
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => "error",
                'message' => "Server error",
                'data' => $e->getMessage(),
            ]);
        }
    }
}
