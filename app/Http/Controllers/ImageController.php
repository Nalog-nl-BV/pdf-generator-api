<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\PdfToImage\Pdf;

class ImageController extends Controller
{
    public function convertPdfToImage($documentFileName, $imageName)
    {
        $pdfPath = storage_path('app/public/Certificates/' . $documentFileName);
        $outputPath = storage_path("app/public/Certificates/" . $imageName);

        try {
            $pdf = new Pdf($pdfPath);
            $pdf->saveImage($outputPath);
            return true;
        } catch (PdfDoesNotExist $e) {
            return false;
        }
        // Additional options:
        // ->setResolution(300) // Set the image resolution (default is 150)
        // ->setOutputFormat('png') // Set the output image format (default is jpg)
    }
}
