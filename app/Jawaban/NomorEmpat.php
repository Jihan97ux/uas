<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class NomorEmpat {

    public function getJson() {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Ambil semua event
            $data = Event::where('user_id', Auth::id())->get();

            // Format data untuk calendar
            $formattedData = $data->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'start' => $event->start,
                    'end' => $event->end,
                    'color' => 'blue'
                ];
            })->toArray();

            // Log data sebelum dikirim
            Log::info('Sending JSON response:', ['data' => $formattedData]);

            // Pastikan encoding JSON bersih
            $jsonString = json_encode($formattedData, JSON_PRETTY_PRINT);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('JSON encoding error: ' . json_last_error_msg());
            }

            return response($jsonString, 200)
                ->header('Content-Type', 'application/json')
                ->header('X-Debug-Info', 'Formatted by NomorEmpat');
        } 
        catch (\Exception $e) {
            Log::error('Error in getJson: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}