<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('pdf-generate', [PdfController::class, 'PDFGenerate']);
Route::post('pdf-clear', [PdfController::class, 'PDFClear']);
Route::post('certificate', [CertificateController::class, 'CertificateGenerate']);
Route::post('pdf-to-image', [ImageController::class, 'convertPdfToImage']);

