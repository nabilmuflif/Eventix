<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('event')->get();
        return view('dashboard.user.booking-history', compact('bookings'));
    }

    public function dashboard()
    {
        $user = Auth::user(); // Ambil pengguna login
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the dashboard.');
        }

        $favorites = $user->favorites; // Ambil event favorit pengguna

        return view('dashboard.user.home', compact('user', 'favorites'));
    }

    public function home()
    {
        // Arahkan ke tampilan atau data yang sesuai
        return view('dashboard.user.home'); // Ganti 'user.home' dengan tampilan yang diinginkan
    }
    // Menampilkan profil pengguna
    public function showProfile()
    {
        return view('dashboard.user.profile');
    }

    // Mengupdate profil pengguna
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    // Menampilkan riwayat pemesanan (sebagai contoh)
    public function bookingHistory()
    {
        // Asumsikan ada model Booking untuk memanggil data pemesanan
        $bookings = Auth::user()->bookings; // Gantilah ini sesuai dengan relasi yang ada di model Booking

        return view('user.booking-history', compact('bookings'));
    }
}
