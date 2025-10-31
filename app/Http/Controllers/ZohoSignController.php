<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZohoSign\ZohoSignService;
use Illuminate\Support\Facades\Storage;

class ZohoSignController extends Controller
{
    private $zohoSignService;

    public function __construct(ZohoSignService $zohoSignService)
    {
        $this->zohoSignService = $zohoSignService;
    }

    public function showForm()
    {
        return view('zoho-sign.form');
    }
    
    public function testWithStaticFile(Request $request)
    {
        // Simplified validation for testing
        if (empty($request->request_name)) {
            return redirect()->back()->with('error', 'Request name is required.');
        }
        if (empty($request->recipient_email)) {
            return redirect()->back()->with('error', 'Recipient email is required.');
        }
        if (empty($request->recipient_name)) {
            return redirect()->back()->with('error', 'Recipient name is required.');
        }

        try {
            // Use static PDF file
            $fullPath = storage_path('app/LCC1000000061.pdf');
            
            if (!file_exists($fullPath)) {
                return redirect()->back()->with('error', '❌ Test PDF file not found.');
            }

            // Create document
            $response = $this->zohoSignService->createDocument(
                $request->request_name,
                $request->recipient_email,
                $request->recipient_name,
                $fullPath,
                $request->private_notes ?? ''
            );

            \Log::info('Create Document Response: ' . json_encode($response));
            
            if (isset($response['requests']['request_id'])) {
                $requestId = $response['requests']['request_id'];
                $actionId = $response['requests']['actions'][0]['action_id'] ?? null;
                $documentId = $response['requests']['document_ids'][0]['document_id'] ?? null;
                
                \Log::info('Extracted IDs - Request: ' . $requestId . ', Action: ' . $actionId . ', Document: ' . $documentId);
                
                if ($actionId && $documentId) {
                    // Submit document for signature
                    $submitResponse = $this->zohoSignService->submitDocument($requestId, $actionId, $documentId);
                    
                    if (isset($submitResponse['status']) && $submitResponse['status'] === 'success') {
                        return redirect()->back()->with('success', '✅ Document sent for signature successfully! Request ID: ' . $requestId . '. The recipient will receive an email to sign the document.');
                    } else {
                        return redirect()->back()->with('error', '❌ Document created but failed to submit for signature. Response: ' . json_encode($submitResponse));
                    }
                } else {
                    return redirect()->back()->with('error', '❌ Document created but missing action_id or document_id. Response: ' . json_encode($response));
                }
            }

            return redirect()->back()->with('error', '❌ Failed to send document for signature. Response: ' . json_encode($response));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error sending document: ' . $e->getMessage());
        }
    }

    public function sendForSignature(Request $request)
    {
        // Debug: Check PHP upload settings
        $maxFileSize = ini_get('upload_max_filesize');
        $maxPostSize = ini_get('post_max_size');
        $memoryLimit = ini_get('memory_limit');
        
        // Debug: Log all request data
        \Log::info('PHP Settings - upload_max_filesize: ' . $maxFileSize . ', post_max_size: ' . $maxPostSize . ', memory_limit: ' . $memoryLimit);
        \Log::info('Request data: ' . json_encode($request->all()));
        \Log::info('Has file: ' . ($request->hasFile('document') ? 'yes' : 'no'));
        \Log::info('Files: ' . json_encode($request->allFiles()));
        \Log::info('$_FILES: ' . json_encode($_FILES));
        
        // Debug: Check if file is present
        if (!$request->hasFile('document')) {
            $errorMsg = '❌ No file uploaded. Please select a PDF file. ';
            $errorMsg .= 'PHP Limits: upload_max_filesize=' . $maxFileSize . ', post_max_size=' . $maxPostSize;
            if (isset($_FILES['document']['error'])) {
                $errorMsg .= ', Upload Error Code: ' . $_FILES['document']['error'];
            }
            return redirect()->back()->with('error', $errorMsg);
        }
        
        if (!$request->file('document')->isValid()) {
            return redirect()->back()->with('error', '❌ File upload failed. Error: ' . $request->file('document')->getErrorMessage());
        }
        
        // Simplified validation for testing
        if (empty($request->request_name)) {
            return redirect()->back()->with('error', 'Request name is required.');
        }
        if (empty($request->recipient_email)) {
            return redirect()->back()->with('error', 'Recipient email is required.');
        }
        if (empty($request->recipient_name)) {
            return redirect()->back()->with('error', 'Recipient name is required.');
        }

        try {
            // Store uploaded file temporarily
            $file = $request->file('document');
            $filePath = $file->storeAs('temp', $file->getClientOriginalName(), 'local');
            $fullPath = storage_path('app/' . $filePath);

            // Create document
            $response = $this->zohoSignService->createDocument(
                $request->request_name,
                $request->recipient_email,
                $request->recipient_name,
                $fullPath,
                $request->private_notes ?? ''
            );

            // Clean up temporary file
            Storage::disk('local')->delete($filePath);

            if (isset($response['requests']['request_id'])) {
                return redirect()->back()->with('success', '✅ Document sent for signature successfully! Request ID: ' . $response['requests']['request_id'] . '. The recipient will receive an email to sign the document.');
            }

            return redirect()->back()->with('error', '❌ Failed to send document for signature. Please check your document and try again.');

        } catch (\Exception $e) {
            // Clean up temporary file if it exists
            if (isset($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
            
            return redirect()->back()->with('error', '❌ Error sending document: ' . $e->getMessage());
        }
    }


     public function getRequestDetails($Request_Id = 135301000000067179){
        try {
            $response = $this->zohoSignService->getRequestDetails($Request_Id);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
     }

}