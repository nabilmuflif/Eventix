@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Your Bookings</h1>

    @if($bookings->isEmpty())
        <p>You have no bookings yet.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Status</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->event->name }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
