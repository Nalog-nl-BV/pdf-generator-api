<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateGenerateRequest;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mpdf\HTMLParserMode;
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
            $data = $request->validated();

            $widthInPx = 1280;
            $heightInPx = 905;
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
                        "caveat" => [
                            'R' => "Caveat/static/Caveat-Bold.ttf",
                            'useOTL' => 0xFF,
                            'useKashida' => 75,
                        ],
                        "montserrat" => [
                            'R' => "Montserrat/static/Montserrat-Regular.ttf",
                            'M' => "Montserrat/static/Montserrat-Medium.ttf",
                            'B' => "Montserrat/static/Montserrat-Bold.ttf",
                            'useOTL' => 0xFF,
                            'useKashida' => 75,
                        ],
                        "pacifico" => [
                            'R' => "Pacifico/Pacifico-Regular.ttf",
                            'useOTL' => 0xFF,
                            'useKashida' => 75,
                        ],
                    ],
                'default_font' => 'caveat'
            ]);

            $documentFileName = $data["fileName"] . ".pdf";
            $imageName = $data["fileName"] . ".jpg";

            $document->SetDefaultBodyCSS('background', "url('https://internal.nalog.nl/wp-content/uploads/2023/05/photo_2023-05-08_14-55-30.jpg') no-repeat left center");

            $html = new HtmlController();

            $data = [
                "token" => $data["token"],
                "number" => $data["certificateNumber"],
                "date" => $data["date"],
                "clientName" => $data["clientName"],
                "employeeName" => $data["employeeName"],
                "discount" => $data["discount"],
                "discountType" => $data["discountType"],
                "offers" => $data["offers"],
//                "offers" => [
//                    [
//                        "title" => "Offer - 1",
//                        "link" => "https://www.nalog.nl/vse-uslugi/yuridiceskim-licam/registraciya-firm-2/registraciya-bv/",
//                    ],
//                    [
//                        "title" => "Offer - 2",
//                        "link" => "https://www.nalog.nl/vse-uslugi/yuridiceskim-licam/registraciya-firm-2/registraciya-bv/",
//                    ],
//                    [
//                        "title" => "Offer - 3",
//                        "link" => "",
//                    ],
//                ]
            ];
            $document->WriteHTML($html->getHtml("certificate-eng", $data));

            Storage::disk('public')->put('/Certificates/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));

            (new ImageController)->convertPdfToImage($documentFileName, $imageName);

            return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
                "token" => $data["token"],
                "bucket_name" => "nalog",
                "dir_name" => "certificates",
                "is_public" => true,
                "files_data" => [
                    Storage::disk('public')->url('/Certificates/' . $documentFileName) => Hash::make($documentFileName),
                    Storage::disk('public')->url('/Certificates/' . $imageName) => Hash::make($imageName)
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
