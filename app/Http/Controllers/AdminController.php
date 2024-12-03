<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function home()
    {
        $events = Event::all();
        return view('home', compact('events'));
    }

    public function dashboard()
    {
        $event = Event::latest()->first();  
        $totalUsers = User::count(); // Menghitung total pengguna
        $totalevent = Event::count();

        return view('dashboard.admin.home', compact('event', 'totalUsers', 'totalevent'));  
    }



    public function manageUsers()
    {
        $users = User::all();
        return view('dashboard.admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('dashboard.admin.users.create');
    }

    
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,organizer,user',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:admin,organizer,user',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => $request->filled('password') ? bcrypt($validated['password']) : $user->password,
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function manageEvents()
    {
        $events = Event::where('created_by', Auth::id())->get();
        return view('dashboard.admin.events.index', compact('events'));
    }
    public function createEvent()
    {
        return view('dashboard.admin.events.create');
    }

public function storeEvent(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'event_date' => 'required|date',
        'location' => 'required|string',
        'ticket_price' => 'required|numeric|min:0',
        'ticket_quota' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $event = new Event();
    $event->name = $validated['name'];
    $event->description = $validated['description'];
    $event->event_date = $validated['event_date'];
    $event->location = $validated['location'];
    $event->ticket_price = $validated['ticket_price'];
    $event->ticket_quota = $validated['ticket_quota'];

    $event->created_by = Auth::id(); 


    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('events', 'public'); 
        $event->image = $imagePath;
    }

    $event->save();

    return redirect()->route('admin.events')->with('success', 'Event created successfully!');
}

    

    public function editEvent($id)
    {
        $event = Event::where('id', $id)->where('created_by', Auth::id())->firstOrFail();
        return view('dashboard.admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::where('id', $id)->where('created_by', Auth::id())->firstOrFail();
        $event->update($request->all());
        return redirect()->route('admin.events');
    }


    public function deleteEvent($id)
    {
        $event = Event::where('id', $id)->where('created_by', Auth::id())->firstOrFail();
        $event->delete();
        return redirect()->route('admin.events');
    }   
}
