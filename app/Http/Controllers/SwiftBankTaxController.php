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

            $documentFileName = $data["fileName"] ."_" . uniqid() . ".pdf";

            $html = new HtmlController();

            $templateData = [
                "date" => $data["date"],
                "name" => $data["name"],
                "bsn" => $data["bsn"],
                "birthday" => $data["birthday"],
                "bank_name" => $data["bank_name"],
                "full_name" => $data["full_name"],
                "iban" => $data["iban"],
                "bank_address" => $data["bank_address"],
            ];

            $document->WriteHTML($html->getHtml("swift-bank-tax-office", $templateData));

            Storage::disk('public')->put('/Documents/swift_bank_taxes/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));

            return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
                "token" => $data["token"],
                "bucket_name" => "nalog",
                "dir_name" => "swift_bank_taxes",
                "is_public" => true,
                "files_data" => [
                    Storage::disk('public')->url('/Documents/swift_bank_taxes/' . $documentFileName) => uniqid() . '.pdf',
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
