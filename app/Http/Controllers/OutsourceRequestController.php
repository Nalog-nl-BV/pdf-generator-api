<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutsourceRequestRequest;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class OutsourceRequestController extends Controller
{
    public function index(OutsourceRequestRequest $request)
    {
        try {
            $data = $request->validated();

            $widthInPx = 900;
            $heightInPx = 1250;
            $widthInMm = $widthInPx * 0.2645833333;
            $heightInMm = $heightInPx * 0.2645833333;

            $document = new Mpdf([
                'format' => [$widthInMm, $heightInMm], // розмір сторінки в міліметрах (8.5 x 11 дюймів)
            ]);

            $documentFileName = $data["fileName"] ."_" . uniqid() . ".pdf";

            $html = new HtmlController();

            $timestamp = time();
            $hash = substr(md5($timestamp), 0, 28);

            $templateData = [
                "date" => $data["date"],
                "number" => $data["number"],
                "accountant_name" => $data["accountant_name"],
                "hash" => $hash,
                "comment" => $data["comment"],
                "orders" => $data["orders"],
            ];

            $document->SetDefaultBodyCSS('background', "url('https://internal.nalog.nl/wp-content/uploads/2023/05/photo_2023-05-16_15-14-20.jpg') no-repeat left center");
            $document->SetDefaultBodyCSS('background-image-opacity', "0.1");

            $document->WriteHTML($html->getHtml("outsource-request", $templateData));

            Storage::disk('public')->put('/Documents/outsource_requests/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));

            return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
                "token" => $data["token"],
                "bucket_name" => "nalog",
                "dir_name" => "outsource_requests",
                "is_public" => true,
                "files_data" => [
                    Storage::disk('public')->url('/Documents/outsource_requests/' . $documentFileName) => uniqid() . '.pdf',
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
