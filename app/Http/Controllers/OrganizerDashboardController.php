<?php

namespace App\Http\Controllers;

use App\Models\Event;   
use Illuminate\Http\Request;

class OrganizerDashboardController extends Controller
{
    public function index()
    {
        // Ambil data acara (misalnya, acara terbaru atau yang sedang berlangsung)
        $event = Event::latest()->first();  // Atau ambil acara yang sesuai dengan kondisi Anda
    
        return view('dashboard.organizer.home', compact('event'));  // Pastikan variabel 'event' dikirim ke view
    }
}
