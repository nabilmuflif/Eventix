<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerDashboardController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\TicketManagementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OrganizerMiddleware;




Route::middleware(['auth'])->group(function () {
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/event/{id}/booking', [BookingController::class, 'showBookingForm'])->name('event.booking.form');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/event/{id}/book', [BookingController::class, 'showBookingForm'])->name('event.book');
    Route::post('/event/{id}/book', [BookingController::class, 'bookTicket'])->name('event.book.store');
    Route::put('/booking/{booking}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
});

    
// Middleware untuk admin
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Routes for Users
    Route::prefix('admin/users')->group(function () {
        Route::get('/', [AdminController::class, 'manageUsers'])->name('admin.users');
        Route::get('/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });

    // Admin Routes for Events
    Route::prefix('admin/events')->group(function () {
        Route::get('/', [AdminController::class, 'manageEvents'])->name('admin.events');
        Route::get('/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
        Route::get('/{id}/edit', [AdminController::class, 'editEvent'])->name('admin.events.edit');
        Route::put('/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
        Route::post('/', [AdminController::class, 'storeEvent'])->name('admin.events.store');
        Route::delete('/{event}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
    });
});

// Middleware untuk organizer
Route::middleware(OrganizerMiddleware::class)->group(function () {
    Route::get('/organizer/dashboard', [OrganizerDashboardController::class, 'index'])->name('organizer.dashboard');
    // Organizer Routes for Events
    Route::prefix('organizer/events')->group(function () {
        Route::get('/', [OrganizerController::class, 'manageEvents'])->name('organizer.events');
        Route::get('/create', [OrganizerController::class, 'createEvent'])->name('organizer.events.create');
        Route::post('/', [OrganizerController::class, 'storeEvent'])->name('organizer.events.store');
        Route::get('/{event}/edit', [OrganizerController::class, 'editEvent'])->name('organizer.events.edit');
        Route::put('/{event}', [OrganizerController::class, 'updateEvent'])->name('organizer.events.update');
        Route::delete('/{event}', [OrganizerController::class, 'deleteEvent'])->name('organizer.events.delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/user/booking-history', [UserController::class, 'history'])->name('user.booking-history');
    Route::get('/user/favorite-events', [UserController::class, 'favoriteEvents'])->name('user.favorite-events');
});

Route::post('/events/{event}/favorite', [EventController::class, 'toggleFavorite'])->name('event.favorite.toggle');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');


// Ticket Management Routes for Admin and Organizer
Route::middleware('auth')->group(function () {
    // View all bookings for an event
    Route::get('/admin/tickets/{event?}', [TicketManagementController::class, 'viewBookings'])->name('admin.tickets.view');

    // Manage ticket status (Approve or Cancel)
    Route::post('/admin/tickets/{booking}/status', [TicketManagementController::class, 'manageTicketStatus'])->name('admin.tickets.status');

    // Generate Ticket Reports
    Route::get('/admin/tickets/reports', [TicketManagementController::class, 'generateReports'])->name('admin.tickets.reports');
    Route::get('/admin/tickets/{booking}/approve', [TicketManagementController::class, 'approve'])
    ->name('admin.tickets.approve');
Route::get('/admin/tickets/{booking}/cancel', [TicketManagementController::class, 'cancel'])
    ->name('admin.tickets.cancel');
});

Route::middleware('auth')->group(function () {
    // Dashboard User
    Route::get('/dashboard/user/home', [UserController::class, 'home'])->name('user.home');

    // Dashboard Admin
    Route::get('/dashboard/admin/home', [AdminController::class, 'home'])->name('admin.home');

    // Dashboard Organizer
    Route::get('/dashboard/organizer/home', [OrganizerController::class, 'home'])->name('organizer.home');
});

// Rute utama dashboard untuk mengarahkan ke dashboard spesifik berdasarkan peran
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role == 'admin') {
        return redirect()->route('admin.home');
    } elseif ($user->role == 'organizer') {
        return redirect()->route('organizer.home');
    } elseif ($user->role == 'user') {
        return redirect()->route('user.home');
    }
    return redirect('/');
})->name('dashboard');

Route::get('/events/{id}', [EventController::class, 'detail'])
    ->name('events.detail');
    
Route::get('admin/tickets/{event}', [TicketManagementController::class, 'viewBookings'])->name('admin.tickets.view');


// Route umum untuk pengguna yang belum login
Route::get('events/{event}', [EventController::class, 'show']); // Melihat detail acara
Route::get('/events', [EventController::class, 'catalog'])->name('events.catalog');


// Route utama
Route::get('/', [HomeController::class, 'index'])->name('home');


// Auth Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// Route tambahan
require __DIR__ . '/auth.php';
