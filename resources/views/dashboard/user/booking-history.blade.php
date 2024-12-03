@extends('layouts.master')

@section('content')
<div class="container booking-history">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">
                    <i class="fas fa-ticket-alt text-primary me-2"></i>
                    Booking History
                </h1>
                
                <div class="filter-options">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="statusFilter" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-2"></i>
                            Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="statusFilter">
                            <li><a class="dropdown-item" href="#">All Bookings</a></li>
                            <li><a class="dropdown-item" href="#">Approved</a></li>
                            <li><a class="dropdown-item" href="#">Pending</a></li>
                            <li><a class="dropdown-item" href="#">Cancelled</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($bookings->isEmpty())
                <div class="no-bookings text-center py-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-muted">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3 class="mb-3">No Bookings Found</h3>
                    <p class="text-muted">You haven't made any bookings yet.</p>
                    <a href="#" class="btn btn-primary mt-3">
                        Explore Events
                    </a>
                </div>
            @else
                <div class="bookings-list">
                    @foreach($bookings as $booking)
                        <div class="card booking-card mb-3 border-start border-4 
                            @switch($booking->status)
                                @case('approved') border-success @break
                                @case('pending') border-warning @break
                                @case('cancelled') border-danger @break
                                @default border-secondary
                            @endswitch
                        ">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center mb-2">
                                            <h5 class="card-title mb-0 me-3">
                                                {{ $booking->event->name }}
                                            </h5>
                                            <span class="badge 
                                                @switch($booking->status)
                                                    @case('approved') bg-success @break
                                                    @case('pending') bg-warning text-dark @break
                                                    @case('cancelled') bg-danger @break
                                                    @default bg-secondary
                                                @endswitch
                                            ">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>

                                        <div class="booking-meta text-muted">
                                            <div class="mb-1">
                                                <i class="fas fa-calendar text-primary me-2"></i>
                                                Booked on: {{ $booking->created_at->format('d M Y H:i') }}
                                            </div>                                 
                                        </div>
                                    </div>


                                    @if($booking->status == 'approved') <!-- Show cancel button only if the status is approved -->
                                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Cancel Booking</button>
                                    </form>
                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            @endif
        </div>
    </div>
</div>
@endsection


