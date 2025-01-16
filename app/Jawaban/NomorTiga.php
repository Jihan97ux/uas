<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorTiga {

    public function getData() {
        $data = Event::where('user_id', Auth::id())->get();  // Ambil semua events berdasarkan user_id
        return $data;
    }

    public function getSelectedData(Request $request) {
        $data = Event::find($request->id);  // Ambil data berdasarkan ID
        return response()->json($data);   // Kirim data JSON jika ditemukan
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
        ]);

        $event = Event::find($request->id);

		echo $event;

        if ($event) {
            $event->update([
                'name' => $request->name,
                'start' => $request->start,
                'end' => $request->end,
            ]);
        }

        return redirect()->route('event.home')->with('success', 'Event berhasil diperbarui');
    }

    public function delete(Request $request) {
        $event = Event::find($request->id);

        if ($event) {
            $event->delete();
        }

        return redirect()->route('event.home')->with('success', 'Event berhasil dihapus');
    }
}
