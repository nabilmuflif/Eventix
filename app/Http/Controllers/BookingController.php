<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Ambil event berdasarkan ID
        $event = Event::findOrFail($validated['event_id']);
    
        // Periksa apakah kuota mencukupi
        if ($validated['quantity'] > $event->ticket_quota) {
            return redirect()->back()->with('error', 'Jumlah tiket yang diminta melebihi kuota tersedia.');
        }
    
        // Simpan data pemesanan
        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'quantity' => $validated['quantity'],
            'status' => 'pending',
        ]);
    
        // Kurangi kuota tiket
        $event->decrement('ticket_quota', $validated['quantity']);
    
        return redirect()->route('event.book', $event->id)
                         ->with('success', 'Tiket berhasil dipesan!');
    }
    


    public function showBookingForm($id)
    {
        $event = Event::findOrFail($id); // Cari event berdasarkan ID
        return view('events.book', compact('event'));
    }
    

public function bookTicket(Request $request, $id)
{
    $event = Event::findOrFail($id);

    // Validasi kuota tiket
    if ($event->ticket_quota <= 0) {
        return redirect()->back()->with('error', 'Tickets are sold out.');
    }

    // Validasi apakah pengguna sudah memesan tiket untuk event ini
    $existingBooking = Booking::where('user_id', Auth::id())
        ->where('event_id', $event->id)
        ->where('status', '!=', 'cancelled')
        ->first();

    if ($existingBooking) {
        return redirect()->back()->with('error', 'You have already booked this event.');
    }

    // Proses pemesanan tiket
    Booking::create([
        'user_id' => Auth::id(),
        'event_id' => $event->id,
        'status' => 'pending',
    ]);

    // Kurangi kuota tiket
    $event->decrement('ticket_quota');

    return redirect()->route('user.bookings.history')->with('success', 'Ticket booked successfully!');
}

public function cancelBooking(Booking $booking)
{
    // Pastikan booking milik user yang sedang login
    if ($booking->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to cancel this booking.');
    }

    // Ubah status booking menjadi cancelled
    $booking->status = 'cancelled';
    $booking->save();

    // Tambahkan kuota tiket kembali ke event
    $booking->event->increment('ticket_quota');

    return redirect()->route('user.booking-history')->with('success', 'Your booking has been cancelled successfully.');
}

}
