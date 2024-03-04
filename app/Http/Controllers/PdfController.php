<?php

namespace App\Http\Controllers;

use App\Http\Requests\PDFDeleteRequest;
use App\Http\Requests\PDFGenerateRequest;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class PdfController extends Controller
{
    /**
     * @param PDFGenerateRequest $request
     * @return JsonResponse|Response
     */
    public function PDFGenerate(PDFGenerateRequest $request): JsonResponse|Response|int
    {
        try {
            $data = $request->validated();

            $margins = $data['margins'] ?? true;

            $serverFolderPath = $data['path'] ?? "";

            $orientation = $data['orientation'] ?? "P";

            $widthInPx = $data['width'] ?? null;
            $heightInPx = $data['height'] ?? null;

            $widthInMm = $widthInPx ? $widthInPx * 0.2645833333 : null;
            $heightInMm = $heightInPx ? $heightInPx * 0.2645833333 : null;

            $format = ($widthInMm && $heightInMm) ? [$heightInMm, $widthInMm] : 'A4';

            $document = new Mpdf([
                'mode' => 'utf-8',
                'format' => $format, // розмір сторінки в міліметрах (8.5 x 11 дюймів)
                'margin_left' => $margins ? 15 : 0,
                'margin_right' => $margins ? 15 : 0,
                'margin_top' => $margins ? 16 : 0,
                'margin_bottom' => $margins ? 16 : 0,
                'orientation' => $orientation,
            ]);

            $documentFileName = $data["name"] ."_" . uniqid() . ".pdf";

            if ($data["css"])
                $document->WriteHTML($data["css"], HTMLParserMode::HEADER_CSS);

//            $document->SetDefaultBodyCSS('background', "url('C:\programing\OpenServer\domains\PDF_generator\public\\nalog_background.jpg') no-repeat left center");
//            $document->SetDefaultBodyCSS('background-image-opacity', "0.1");

            $document->WriteHTML($data["html"]);

            if ($data["type"] == "base64") {
                return response()->json([
                    'code' => 200,
                    'status' => "success",
                    'message' => null,
                    'data' => base64_encode($document->Output($documentFileName, Destination::STRING_RETURN)),
                ]);

            } else { /// type = file
                Storage::disk('public')->put('/PDFs/' . $documentFileName, $document->Output($documentFileName, Destination::STRING_RETURN));
                return Http::post('https://hub.nalog.nl/api/v1/storage/store', [
                    "token" => $data["token"],
                    "bucket_name" => "nalog",
                    "dir_name" => "PDFs/" . $serverFolderPath,
                    "is_public" => true,
                    "files_data" => [
                        Storage::disk('public')->url('/PDFs/' . $documentFileName) => uniqid() . '.pdf'
                    ]
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => "error",
                'message' => "Server error",
                'data' => $e->getMessage(),
            ]);
        }
    }

    public function PDFClear(PDFDeleteRequest $request): JsonResponse|bool
    {
        try {
            $data = $request->validated();

            if(!$data['delete_all']) {
                array_filter(Storage::disk('public')->files('/PDFs'), function ($item) {
                    $modifiedDate = Storage::disk('public')->lastModified($item);
                    if(now()->timestamp - $modifiedDate > 1000000) {
                        Storage::disk('public')->delete($item);
                    }
                });
            } else {
                Storage::disk('public')->deleteDirectory('PDFs');
                Storage::disk('public')->deleteDirectory('Certificates');
                Storage::disk('public')->deleteDirectory('Documents');
            }

            return response()->json([
                'code' => 200,
                'status' => "success",
                'message' => null,
                'data' => null,
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
