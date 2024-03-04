<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateGenerateRequest;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mpdf\Output\Destination;

class CertificateController extends Controller
{
    /**
     * @param CertificateGenerateRequest $request
     * @return JsonResponse|Response
     */
    public function CertificateGenerate(CertificateGenerateRequest $request)
    {
        try {
            $data = $request;

            $widthInPx = 1533;
            $heightInPx = 700;
            $widthInMm = $widthInPx * 0.2645833333;
            $heightInMm = $heightInPx * 0.2645833333;

            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];

            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $document = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => [$widthInMm, $heightInMm], // розмір сторінки в міліметрах (8.5 x 11 дюймів)
                'orientation' => 'P',
                'fontDir' => array_merge($fontDirs, [
                    base_path("public/fonts"),
                ]),
                'fontdata' => $fontData + [ // lowercase letters only in font key
                        "montserrat" => [
                            'R' => "Montserrat/static/Montserrat-Regular.ttf",
                            'B' => "Montserrat/static/Montserrat-Bold.ttf",
                            'useOTL' => 0xFF,
                            'useKashida' => 75,
                        ],
                        "montserrat-black" => [
                            'R' => "Montserrat/static/Montserrat-SemiBold.ttf",
                            'B' => "Montserrat/static/Montserrat-Black.ttf",
                            'useOTL' => 0xFF,
                            'useKashida' => 75,
                        ],
                    ],
                'default_font' => 'montserrat'
            ]);

            $documentFileName = $data["fileName"] ."_" . uniqid() . ".pdf";
            $imageName = $data["fileName"] ."_" . uniqid() . ".jpg";

            $document->SetDefaultBodyCSS('background', "url('https://internal.nalog.nl/wp-content/uploads/2023/05/reclAsset-1-4.png') no-repeat left center");

            $html = new HtmlController();

            $data = [
                "token" => $data["token"],
                "language" => $data["language"],
                "number" => $data["certificateNumber"],
                "date" => $data["date"],
                "clientName" => $data["clientName"],
                "employeeName" => $data["employeeName"],
                "discount" => $data["discount"],
                "discountType" => $data["discountType"],
                "offer" => $data["offer"],
                "image" => $data["image"],
            ];

            $document->WriteHTML($html->getHtml("certificate-eng", $data));

            Storage::disk('public')->put('/Certificates/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));
            if($data["image"]) {
                if((new ImageController)->convertPdfToImage($documentFileName, $imageName)) {
                    $filesData = [
                        Storage::disk('public')->url('/Certificates/' . $documentFileName) => uniqid() . '.pdf',
                        Storage::disk('public')->url('/Certificates/' . $imageName) => uniqid() . '.jpg',
                    ];
                } else {
                    $filesData = [
                        Storage::disk('public')->url('/Certificates/' . $documentFileName) => uniqid() . '.pdf',
                    ];
                }
            } else {
                $filesData = [
                    Storage::disk('public')->url('/Certificates/' . $documentFileName) => uniqid() . '.pdf',
                ];
            }

            return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
                "token" => $data["token"],
                "bucket_name" => "nalog",
                "dir_name" => "certificates",
                "is_public" => true,
                "files_data" => $filesData
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
