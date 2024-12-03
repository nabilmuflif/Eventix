<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class OrganizerController extends Controller
{


    public function home()
    {
        // Ambil semua event untuk admin
        $events = Event::all();
        return view('home', compact('events'));
    }

    public function dashboard()
    {
        // Ambil data acara (misalnya, acara terbaru atau yang sedang berlangsung)
        $event = Event::latest()->first();  // Atau ambil acara yang sesuai dengan kondisi Anda
    
        return view('dashboard.organizer.home', compact('event'));  // Pastikan variabel 'event' dikirim ke view
    }

    public function manageEvents()
    {
        $events = Event::where('created_by', Auth::id())->get();
        return view('dashboard.organizer.events.index', compact('events'));
    }


    public function createEvent()
    {
        return view('dashboard.organizer.events.create');
    }

    public function storeEvent(Request $request)
    {
        // Validasi input termasuk file gambar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);
    
        // Menyimpan event
        $event = new Event();
        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->event_date = $validated['event_date'];
        $event->location = $validated['location'];
        $event->ticket_price = $validated['ticket_price'];
        $event->ticket_quota = $validated['ticket_quota'];
    
        // Menangani kolom 'created_by' dengan ID pengguna yang login
        $event->created_by = Auth::id(); // Pastikan pengguna login
    
        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public'); // Menyimpan di folder 'public/events'
            $event->image = $imagePath;
        }
    
        // Menyimpan event ke database
        $event->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('organizer.events')->with('success', 'Event created successfully!');
    }
    public function editEvent($id)
    {
        // Pastikan event yang di-edit adalah event yang dibuat oleh organizer yang sedang login
        $event = Event::where('id', $id)->where('created_by', Auth::id())->firstOrFail();
        return view('dashboard.organizer.events.edit', compact('event'));
    }


    public function updateEvent(Request $request, $id)
    {
        // Validasi dan update event
        $event = Event::where('id', $id)->where('created_by', Auth::id())->firstOrFail();
        $event->update($request->all());
        return redirect()->route('organizer.events');
    }

    public function deleteEvent($id)
    {
        // Menghapus event yang dibuat oleh organizer yang sedang login
        $event = Event::where('id', $id)->where('created_by', Auth::id())->firstOrFail();
        $event->delete();
        return redirect()->route('organizer.events');
    }
}
