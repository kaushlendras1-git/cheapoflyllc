<?php

namespace App\Http\Controllers;

use App\Services\AmadeusSoapService;
use Illuminate\Http\Request;

class AmadeusController extends Controller
{
    protected AmadeusSoapService $amadeusService;

    public function __construct(AmadeusSoapService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function getPnr(Request $request)
    {
        $validatedData = $request->validate([
            'pnr' => 'required|string|size:6',
            'last_name' => 'required|string',
        ]);

        try {
            $response = $this->amadeusService->retrievePnr(
                $validatedData['pnr'],
                $validatedData['last_name']
            );

            // Extract and format the data
            $pnrData = $this->parsePnrResponse($response);

            return response()->json($pnrData);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Parses the SOAP response to extract PNR details.
     * This is an example and may need to be adjusted based on the actual XML structure.
     *
     * @param mixed $response
     * @return array
     */
    protected function parsePnrResponse($response): array
    {
        $pnrData = [
            'pnr_record_locator' => null,
            'passengers' => [],
            'flights' => [],
        ];

        // The amadeus-ws-client library returns an object. You will need to
        // navigate this object to get the specific data you need.
        // The structure depends on the specific message version and data returned.
        // Example: $response->pnrHeader->reservationInfo->reservation->controlNumber;
        // This part requires consulting your official Amadeus documentation.

        // Placeholder for processing the response object
        if (isset($response->pnrHeader->reservationInfo->reservation->controlNumber)) {
            $pnrData['pnr_record_locator'] = (string) $response->pnrHeader->reservationInfo->reservation->controlNumber;
        }

        // Add logic to extract passenger and flight details from the response
        // ...

        return $pnrData;
    }
    }
