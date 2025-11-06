<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthHistory;
use Illuminate\Support\Facades\Http;

class ZohoStatusController extends Controller
{
    public function updateStatus(Request $request)
    {
        $authHistoryId = $request->auth_history_id;
        $zohoDocumentId = $request->zoho_document_id;
        
        try {
            $response = Http::get("http://127.0.0.1:8000/zoho-sign/request-details/{$zohoDocumentId}");
            
            if ($response->successful()) {
                $data = $response->json();
                $status = $data['requests']['request_status'] ?? null;
                
                if ($status) {
                    AuthHistory::where('id', $authHistoryId)->update(['auth_status' => $status]);
                    
                    return response()->json([
                        'success' => true,
                        'status' => $status
                    ]);
                }
            }
            
            return response()->json(['success' => false]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}