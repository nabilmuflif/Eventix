<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TicketManagementController extends Controller
{
    // View all bookings for an event


    public function viewBookings(Event $event)
    {
        // Ambil semua pemesanan untuk acara tertentu yang dimiliki admin
        $bookings = $event->bookings()->with('user')->get();
        return view('dashboard.admin.tickets.view', compact('bookings', 'event'));
    }

public function manageTicketStatus(Request $request, Booking $booking)
{
    // Validasi status booking
    $request->validate([
        'status' => 'required|in:approved,cancelled',
    ]);

    // Ubah status tiket
    $booking->status = $request->input('status');
    $booking->save();

    // Update kuota tiket jika dibatalkan
    if ($booking->status === 'cancelled') {
        $booking->event->increment('ticket_quota');
    }

    return redirect()->route('admin.tickets.view', $booking->event_id)->with('success', 'Booking status updated.');
}


    // Generate ticket sales reports
    public function generateReports()
    {
        // Ambil data pemesanan tiket berdasarkan status
        $bookings = Booking::with('event')->get();
        $totalSales = $bookings->where('status', 'approved')->count();
        $totalRevenue = $bookings->where('status', 'approved')->sum(function($booking) {
            return $booking->event->ticket_price;
        });

        return view('dashboard.admin.tickets.reports', compact('bookings', 'totalSales', 'totalRevenue'));
    }
    public function approve(Booking $booking)
{
    $booking->status = 'approved';
    $booking->save();

    return redirect()->back()->with('success', 'Booking berhasil disetujui');
}

public function cancel(Booking $booking)
{
    $booking->status = 'cancelled';
    $booking->save();

    return redirect()->back()->with('success', 'Booking berhasil dibatalkan');
}
}

