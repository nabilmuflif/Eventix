<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function detail($id)
    {
        // Cari event berdasarkan ID
        $event = Event::findOrFail($id);

        // Kirim ke view detail event
        return view('events.show', compact('event'));
    }

    public function toggleFavorite($eventId)
    {
        $user = Auth::user();
        $event = Event::findOrFail($eventId);

        if ($user->favorites()->where('event_id', $event->id)->exists()) {
            // Hapus dari favorit
            $user->favorites()->detach($eventId);
            return redirect()->back()->with('success', 'Event removed from favorites!');
        } else {
            // Tambahkan ke favorit
            $user->favorites()->attach($eventId);
            return redirect()->back()->with('success', 'Event added to favorites!');
        }
    }

    public function search(Request $request)
    {
        $query = Event::query();
    
        // Logika pencarian
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }
    
        // Transformasi data
        $events = $query->paginate(10)->through(function ($event) {
            // Pastikan date di-parse ke Carbon
            $event->date = $event->date ? Carbon::parse($event->date) : null;
            return $event;
        });
    
        return view('events.search', compact('events'));
    }
    public function catalog()
    {
        $events = Event::latest()->paginate(9);
        
        // Debug: Periksa apakah objek paginasi valid
        
        return view('events.catalog', compact('events'));
    }    


    // Menampilkan detail acara
    public function show($id)
    {
        $event = Event::findOrFail($id); // Menemukan acara berdasarkan ID
        return view('events.show', compact('event')); // Mengirim data acara ke view
    }

    // Metode untuk update event
    public function update(Request $request, $id)
    {
        
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|integer',
            'date_time' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::findOrFail($id);

        // Jika ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/events');
            $event->image = basename($imagePath); // Simpan nama gambar
        }

        // Update data event
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'ticket_price' => $request->ticket_price,
            'ticket_quota' => $request->ticket_quota,
            'date_time' => $request->date_time,
            'created_by' => Auth::id(),  // Menyimpan ID pengguna yang mengupdate event
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }
}

