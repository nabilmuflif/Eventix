@extends('layouts.event')

@section('content')
<div class="container py-5">
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold mb-3">Explore Upcoming Events</h1>
            <p class="lead text-muted">Discover exciting events tailored just for you</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse ($events as $event)
            <div class="col-md-4">
                <div class="card event-card border-0 shadow-sm hover-lift">
                    <div class="position-relative">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="card-img-top event-image">
                        @else
                            <img src="https://via.placeholder.com/400x250" alt="Default Event Image" class="card-img-top event-image">
                        @endif
                        
                        {{-- <div class="event-date-badge">
                            <div class="text-center">
                                <span class="d-block month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                                <span class="d-block day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                            </div>
                        </div> --}}
                    </div>
                    
                    <div class="card-body px-4 pt-3 pb-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0 fw-bold">{{ $event->name }}</h5>
                            <span class="badge bg-soft-primary text-primary">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}
                            </span>
                        </div>
                        
                        <p class="card-text text-muted mb-3">
                            {{ Str::limit($event->description, 100, '...') }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                <i class="far fa-calendar me-2"></i>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                            </span>
                            <a href="{{ url('events/' . $event->id) }}" class="btn btn-sm btn-outline-primary">
                                View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                <h3 class="mb-3">No Events Available</h3>
                <p class="text-muted">Check back later or explore other categories.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $events->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

@push('styles')
<style>
    .event-card {
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .event-image {
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .event-card:hover .event-image {
        transform: scale(1.05);
    }

    .event-date-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(255,255,255,0.9);
        border-radius: 8px;
        padding: 10px;
        min-width: 70px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .event-date-badge .month {
        font-weight: 700;
        color: var(--primary-color);
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .event-date-badge .day {
        font-weight: 900;
        font-size: 1.2rem;
        line-height: 1;
    }

    .bg-soft-primary {
        background-color: rgba(99, 102, 241, 0.1);
    }
</style>
@endpush
@endsection