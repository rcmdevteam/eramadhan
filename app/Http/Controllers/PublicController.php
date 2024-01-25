<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PublicController extends Controller
{
    public function getDataLots()
    {
        // Set appropriate headers for SSE
        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function () {
            // while (true) {
            // Fetch stock status (you can replace this logic with your own)
            $stockStatus = $this->getStockStatus();

            // Send SSE message to the client
            echo "data: " . json_encode($stockStatus) . "\n\n";

            // Flush the output buffer
            ob_flush();
            flush();

            // Sleep for a moment before sending the next update
            // sleep(5);
            // }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }

    private function getStockStatus()
    {
        $lot = 1;
        $quota = 0;
        $lots = [];
        $masjidId = request()->masjid_id;

        foreach (Lot::whereMasjidId($masjidId)->orderBy('hari', 'asc')->get() as $lot) {
            $lots[] = [
                'lid' => $lot->id,
                'mid' => $lot->masjid->id,
                'full' => ($lot->quota - $lot->transactions->where('status', 'paid')->count() == 0) ? 'true' : 'false',
                'available' => ($lot->quota - $lot->transactions->where('status', 'paid')->count()) . '/' . $lot->quota
            ];
        }

        return Response::json([
            'data' => $lots
        ]);
        // Example: Return a random stock status (0 or 1)
        return rand(0, 1);
    }
}
