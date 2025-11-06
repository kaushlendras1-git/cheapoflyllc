<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZohoSign\ZohoSignService;

class ZohoPdfController extends Controller
{
    public function downloadPdf($requestId)
    {
        try {
            $zohoService = new ZohoSignService();
            $pdfContent = $zohoService->downloadPdf($requestId);
            
            // Check if response is valid PDF content
            if (empty($pdfContent)) {
                return response()->json(['error' => 'Empty response from Zoho Sign'], 400);
            }
            
            // Check if it's a PDF by looking at binary header
            $pdfHeader = substr($pdfContent, 0, 4);
            if ($pdfHeader !== '%PDF') {
                // Try to decode as JSON to check for error response
                $jsonResponse = json_decode($pdfContent, true);
                if ($jsonResponse && isset($jsonResponse['message'])) {
                    return response()->json(['error' => 'Zoho API Error: ' . $jsonResponse['message']], 400);
                }
                
                return response()->json([
                    'error' => 'Invalid PDF content received from Zoho Sign',
                    'content_type' => 'Non-PDF response',
                    'response_length' => strlen($pdfContent)
                ], 400);
            }
            
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="signed-document-' . $requestId . '.pdf"');
                
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to download PDF: ' . $e->getMessage()], 500);
        }
    }

    public function downloadCompletionCertificate($requestId)
    {
        try {
            $zohoService = new ZohoSignService();
            $certificateContent = $zohoService->downloadCompletionCertificate($requestId);
            
            // Check if response is valid PDF content
            if (empty($certificateContent) || substr($certificateContent, 0, 4) !== '%PDF') {
                // Log the actual response for debugging
                \Log::error('Invalid certificate response from Zoho: ' . substr($certificateContent, 0, 500));
                
                // Try to decode as JSON to check for error response
                $jsonResponse = json_decode($certificateContent, true);
                if ($jsonResponse && isset($jsonResponse['message'])) {
                    return response()->json(['error' => 'Zoho API Error: ' . $jsonResponse['message']], 400);
                }
                
                // Return the actual response for debugging
                return response()->json([
                    'error' => 'Invalid certificate content received from Zoho Sign',
                    'response_preview' => substr($certificateContent, 0, 200),
                    'response_length' => strlen($certificateContent)
                ], 400);
            }
            
            return response($certificateContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="completion-certificate-' . $requestId . '.pdf"');
                
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to download completion certificate: ' . $e->getMessage()], 500);
        }
    }
}