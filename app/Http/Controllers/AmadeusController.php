<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmadeusController extends Controller
{
    private $amadeusConfig = [
        'endpoint' => 'https://webservices.amadeus.com/1ASIWCHEAPO/PNR_Retrieve',
        'office_id' => 'CHEAPO001',
        'username' => 'WSHEAPO01',
        'password' => 'CHEAPO123',
        'conversation_id' => 'CHEAPO_SESSION_001'
    ];

    public function pnrRetrieve($pnr)
    {
        try {
            $soapEnvelope = $this->buildSoapEnvelope($pnr);
            
            $response = Http::withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
                'SOAPAction' => 'http://webservices.amadeus.com/PNR_Retrieve_21_1_1A'
            ])->post($this->amadeusConfig['endpoint'], $soapEnvelope);

            if ($response->successful()) {
                $xmlResponse = simplexml_load_string($response->body());
                return view('amadeus.pnr-result', [
                    'pnr' => $pnr,
                    'response' => $xmlResponse,
                    'rawXml' => $response->body()
                ]);
            } else {
                return view('amadeus.pnr-error', [
                    'pnr' => $pnr,
                    'error' => 'HTTP Error: ' . $response->status(),
                    'message' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Amadeus PNR Retrieve Error: ' . $e->getMessage());
            return view('amadeus.pnr-error', [
                'pnr' => $pnr,
                'error' => 'System Error',
                'message' => $e->getMessage()
            ]);
        }
    }

    private function buildSoapEnvelope($pnr)
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1" xmlns:ses="http://xml.amadeus.com/2010/06/Session_v3">
    <soap:Header>
        <link:TransactionFlowLink>
            <link:Consumer>
                <link:UniqueID>' . $this->amadeusConfig['conversation_id'] . '</link:UniqueID>
            </link:Consumer>
        </link:TransactionFlowLink>
        <ses:Session>
            <ses:SessionId>' . $this->amadeusConfig['conversation_id'] . '</ses:SessionId>
            <ses:SequenceNumber>1</ses:SequenceNumber>
            <ses:SecurityToken>' . base64_encode($this->amadeusConfig['username'] . ':' . $this->amadeusConfig['password']) . '</ses:SecurityToken>
        </ses:Session>
    </soap:Header>
    <soap:Body>
        <PNR_Retrieve xmlns="http://xml.amadeus.com/PNRRET_21_1_1A">
            <retrievalFacts>
                <retrieve>
                    <type>2</type>
                </retrieve>
                <reservationOrProfileIdentifier>
                    <reservation>
                        <controlNumber>' . strtoupper($pnr) . '</controlNumber>
                    </reservation>
                </reservationOrProfileIdentifier>
            </retrievalFacts>
        </PNR_Retrieve>
    </soap:Body>
</soap:Envelope>';
    }

    public function sessionStatus()
    {
        return response()->json([
            'active' => auth()->check(),
            'user' => auth()->user()->name ?? null,
            'time' => now()->format('H:i:s')
        ]);
    }
}