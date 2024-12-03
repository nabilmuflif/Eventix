@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Ticket Sales Report</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Total Sales: {{ $totalSales }}</h3>
        </div>
        <div class="col-md-6">
            <h3>Total Revenue: ${{ $totalRevenue }}</h3>
        </div>
    </div>

    <h2>Booking List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Event</th>
                <th>Status</th>
                <th>User</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->event->name }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>${{ $booking->event->ticket_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
