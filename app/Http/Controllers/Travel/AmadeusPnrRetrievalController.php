<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmadeusPnrRetrievalController extends Controller
{
    private $username = 'WSCF5CHE';
    private $password = '4skpKbqkD?wQ';
    private $baseUrl = 'https://webservices.amadeus.com';

    public function retrievePnr(Request $request)
    {
        $request->validate([
            'pnr' => 'required|string|min:6|max:6'
        ]);

        try {
            $sessionToken = $this->getSessionToken();
            
            if (!$sessionToken) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to authenticate with Amadeus',
                    'code' => '401'
                ], 401);
            }

            $pnrData = $this->fetchPnrData($sessionToken, $request->pnr);
            
            if (!$pnrData) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'PNR not found or invalid',
                    'code' => '404'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'PNR retrieved successfully',
                'data' => $pnrData,
                'code' => '200'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Amadeus PNR Retrieval Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
                'code' => '500'
            ], 500);
        }
    }

    private function getSessionToken()
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
                'SOAPAction' => 'http://webservices.amadeus.com/Security_Authenticate'
            ])->post($this->baseUrl . '/1ASIWSCF5CHE/webservices/services/1ASIWSCF5CHE', $this->buildAuthSoapRequest());

            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                $sessionToken = (string) $xml->xpath('//ses:Session')[0]['TransactionStatusCode'] ?? null;
                return $sessionToken;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Amadeus Authentication Error: ' . $e->getMessage());
            return null;
        }
    }

    private function fetchPnrData($sessionToken, $pnr)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
                'SOAPAction' => 'http://webservices.amadeus.com/PNR_Retrieve'
            ])->post($this->baseUrl . '/1ASIWSCF5CHE/webservices/services/1ASIWSCF5CHE', $this->buildPnrRetrieveSoapRequest($sessionToken, $pnr));

            if ($response->successful()) {
                return $this->parsePnrResponse($response->body());
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Amadeus PNR Fetch Error: ' . $e->getMessage());
            return null;
        }
    }

    private function buildAuthSoapRequest()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1">
            <soap:Header>
                <add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">1</add:MessageID>
                <add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/Security_Authenticate</add:Action>
                <add:To xmlns:add="http://www.w3.org/2005/08/addressing">' . $this->baseUrl . '/1ASIWSCF5CHE/webservices/services/1ASIWSCF5CHE</add:To>
            </soap:Header>
            <soap:Body>
                <sec:Security_Authenticate>
                    <sec:userIdentifier>
                        <sec:originIdentification>
                            <sec:sourceOffice>' . $this->username . '</sec:sourceOffice>
                        </sec:originIdentification>
                        <sec:originatorTypeCode>U</sec:originatorTypeCode>
                        <sec:originator>' . $this->username . '</sec:originator>
                    </sec:userIdentifier>
                    <sec:dutyCode>
                        <sec:dutyCodeDetails>
                            <sec:referenceQualifier>DUT</sec:referenceQualifier>
                            <sec:referenceIdentifier>SU</sec:referenceIdentifier>
                        </sec:dutyCodeDetails>
                    </sec:dutyCode>
                    <sec:systemDetails>
                        <sec:organizationDetails>
                            <sec:organizationId>' . $this->username . '</sec:organizationId>
                        </sec:organizationDetails>
                    </sec:systemDetails>
                    <sec:passwordInfo>
                        <sec:dataLength>' . strlen($this->password) . '</sec:dataLength>
                        <sec:dataType>E</sec:dataType>
                        <sec:binaryData>' . base64_encode($this->password) . '</sec:binaryData>
                    </sec:passwordInfo>
                </sec:Security_Authenticate>
            </soap:Body>
        </soap:Envelope>';
    }

    private function buildPnrRetrieveSoapRequest($sessionToken, $pnr)
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pnr="http://xml.amadeus.com/PNRRET_17_1_1A">
            <soap:Header>
                <add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">2</add:MessageID>
                <add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/PNR_Retrieve</add:Action>
                <add:To xmlns:add="http://www.w3.org/2005/08/addressing">' . $this->baseUrl . '/1ASIWSCF5CHE/webservices/services/1ASIWSCF5CHE</add:To>
                <ses:Session xmlns:ses="http://xml.amadeus.com/2010/06/Session_v3" TransactionStatusCode="' . $sessionToken . '"/>
            </soap:Header>
            <soap:Body>
                <pnr:PNR_Retrieve>
                    <pnr:retrievalFacts>
                        <pnr:retrieve>
                            <pnr:reservationOrProfileIdentifier>
                                <pnr:reservation>
                                    <pnr:controlNumber>' . $pnr . '</pnr:controlNumber>
                                </pnr:reservation>
                            </pnr:reservationOrProfileIdentifier>
                        </pnr:retrieve>
                    </pnr:retrievalFacts>
                </pnr:PNR_Retrieve>
            </soap:Body>
        </soap:Envelope>';
    }

    private function parsePnrResponse($xmlResponse)
    {
        try {
            $xml = simplexml_load_string($xmlResponse);
            
            // Extract basic PNR information
            $pnrData = [
                'pnr' => (string) $xml->xpath('//pnr:reservationInfo/pnr:reservation/pnr:controlNumber')[0] ?? '',
                'passengers' => [],
                'flights' => [],
                'status' => 'active'
            ];

            // Extract passenger information
            $passengers = $xml->xpath('//pnr:travellerInfo');
            foreach ($passengers as $passenger) {
                $pnrData['passengers'][] = [
                    'name' => (string) $passenger->xpath('.//pnr:surname')[0] ?? '',
                    'first_name' => (string) $passenger->xpath('.//pnr:givenName')[0] ?? '',
                    'type' => (string) $passenger->xpath('.//pnr:passengerType')[0] ?? 'ADT'
                ];
            }

            // Extract flight information
            $flights = $xml->xpath('//pnr:itineraryInfo');
            foreach ($flights as $flight) {
                $pnrData['flights'][] = [
                    'airline' => (string) $flight->xpath('.//pnr:companyId')[0] ?? '',
                    'flight_number' => (string) $flight->xpath('.//pnr:flightNumber')[0] ?? '',
                    'departure_date' => (string) $flight->xpath('.//pnr:departureDate')[0] ?? '',
                    'departure_airport' => (string) $flight->xpath('.//pnr:locationId')[0] ?? '',
                    'arrival_airport' => (string) $flight->xpath('.//pnr:arrivalLocationId')[0] ?? ''
                ];
            }

            return $pnrData;
        } catch (\Exception $e) {
            Log::error('PNR Response Parsing Error: ' . $e->getMessage());
            return null;
        }
    }
}