@extends('layouts.master')

@section('title', 'Edit Event')

@section('content')
<div class="container mt-5">
    <h1>Edit Event</h1>
    <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Event Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" name="event_date" id="event_date" class="form-control" value="{{ $event->event_date }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $event->location }}" required>
        </div>
        <div class="mb-3">
            <label for="ticket_price" class="form-label">Ticket Price</label>
            <input type="number" name="ticket_price" id="ticket_price" class="form-control" step="0.01" value="{{ $event->ticket_price }}" required>
        </div>
        <div class="mb-3">
            <label for="ticket_quota" class="form-label">Ticket Quota</label>
            <input type="number" name="ticket_quota" id="ticket_quota" class="form-control" value="{{ $event->ticket_quota }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Event Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-fluid mt-2" style="max-width: 150px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
