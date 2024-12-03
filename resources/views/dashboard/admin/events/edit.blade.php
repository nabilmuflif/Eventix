<!-- resources/views/admin/events/edit.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Event</h1>
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $event->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $event->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}" required>
            </div>
            <div class="form-group">
                <label for="ticket_price">Ticket Price</label>
                <input type="number" class="form-control" id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}" required>
            </div>
            <div class="form-group">
                <label for="ticket_quota">Ticket Quota</label>
                <input type="number" class="form-control" id="ticket_quota" name="ticket_quota" value="{{ old('ticket_quota', $event->ticket_quota) }}" required>
            </div>
            <div class="form-group">
                <label for="image">Event Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
@endsection
