<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\PdfToImage\Pdf;

class ImageController extends Controller
{
    public function convertPdfToImage()
    {
        if (extension_loaded('imagick')) {
            return "Imagick extension is installed.";
        } else {
            return "Imagick extension is not installed.";
        }
//        $pdfPath = storage_path('app/public/Certificates/test2.pdf');
//        $outputPath = storage_path('app/public/Certificates/test2.jpg');
//
//        // Convert the first page of the PDF to an image
//        try {
//            $pdf = new Pdf($pdfPath);
//            $pdf->saveImage($outputPath);
//            return [
//                "code" => 200,
//                "status" => "success",
//                "message" => null,
//                "data" => $outputPath
//            ];
//        } catch (PdfDoesNotExist $e) {
//            return [
//                "code" => 400,
//                "status" => "error",
//                "message" => $e->getMessage(),
//                "data" => null
//            ];
//        }
//        // Additional options:
//        // ->setResolution(300) // Set the image resolution (default is 150)
//        // ->setOutputFormat('png') // Set the output image format (default is jpg)
    }
}
