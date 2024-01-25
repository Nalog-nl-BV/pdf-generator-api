<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwiftBankTaxRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class OutsourceRequestController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = [
                "date" => '24/01/2024',
                "name" => 'Oleg Bortovsky',
                "bsn" => '12152234234541',
                "birthday" => '16/04/2002',
                "bank_name" => 'Bank Provila',
                "full_name" => 'Oleg Bortovsky',
                "iban" => '121423423423423',
                "bank_address" => 'London 12A',
                "comment" => 'Фактуры Bouwmaat - пронумерованы. Только осталось внести в программу.',
                "orders" => [
                    [
                        '№ н/п' => 1,
                        '№ администрации' => 167,
                        'Наименование Клиента' => 'Ruslan Onderhoudsbedrijf',
                        'Период (за месяц/за квартал)' => '4 квартал',
                        'Комментарий' => 'Bouwmaat',
                    ]
                ]
            ];
//            $data = $request->validated();

            $widthInPx = 900;
            $heightInPx = 1250;
            $widthInMm = $widthInPx * 0.2645833333;
            $heightInMm = $heightInPx * 0.2645833333;

            $document = new Mpdf([
                'format' => [$widthInMm, $heightInMm], // розмір сторінки в міліметрах (8.5 x 11 дюймів)
            ]);
//
            $documentFileName = "test.pdf";
//
            $html = new HtmlController();
//
//            $templateData = [
//                "date" => $data["date"],
//                "name" => $data["name"],
//                "bsn" => $data["bsn"],
//                "birthday" => $data["birthday"],
//                "bank_name" => $data["bank_name"],
//                "full_name" => $data["full_name"],
//                "iban" => $data["iban"],
//                "bank_address" => $data["bank_address"],
//            ];
//
            $document->SetDefaultBodyCSS('background', "url('https://internal.nalog.nl/wp-content/uploads/PDF_EXTENDED_TEMPLATES/images/background.png') no-repeat left center");
            $document->SetDefaultBodyCSS('background-image-opacity', "0.2");
//
            $document->WriteHTML($html->getHtml("outsource-request", $data));

            Storage::disk('public')->put('/Documents/test/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));

//            return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
//                "token" => $data["token"],
//                "bucket_name" => "nalog",
//                "dir_name" => "swift_bank_taxes",
//                "is_public" => true,
//                "files_data" => [
//                    Storage::disk('public')->url('/Documents/swift_bank_taxes/' . $documentFileName) => uniqid() . '.pdf',
//                ]
//            ]);

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
