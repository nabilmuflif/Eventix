@extends('layouts.event')

@section('content')
<div class="container search-results-container">
    @if($events->isEmpty())
        <div class="no-results text-center py-5">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-muted">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    <path d="M11 8v4" />
                    <path d="M11 12h3" />
                </svg>
            </div>
            <h3 class="mb-3">No Events Found</h3>
            <p class="text-muted">Try adjusting your search terms or explore other events.</p>
            <a href="{{ route('events.catalog') }}" class="btn btn-outline-primary mt-3">
                Explore All Events
            </a>
        </div>
    @else
        <div class="search-header mb-4 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">
                Search Results 
                <span class="badge bg-soft-primary text-primary ms-2">
                    {{ $events->total() }} events
                </span>
            </h3>
            <div class="sort-options">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-sort me-2"></i>Sort By
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="#">Date</a></li>
                        <li><a class="dropdown-item" href="#">Popularity</a></li>
                        <li><a class="dropdown-item" href="#">Price</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="events-grid">
            @foreach($events as $event)
                <div class="event-card card mb-4 hover-lift">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <h4 class="card-title mb-3">
                                    {{ $event->name }}
                                    @if($event->is_featured)
                                        <span class="badge bg-warning text-dark ms-2">Featured</span>
                                    @endif
                                </h4>
                                
                                <p class="card-text text-muted mb-3">
                                    {{ Str::limit($event->description, 150) }}
                                </p>
                                
                                <div class="event-meta d-flex align-items-center text-muted">
                                    <div class="me-3">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ $event->location }}
                                    </div>
                                    
                                    @if($event->date)
                                        <div>
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-end">
                                <a href="{{ route('events.detail', $event->id) }}" class="btn btn-primary">
                                    View Details
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper d-flex justify-content-center mt-4">
            {{ $events->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection

@push('styles')

@endpush

@push('scripts')
<script>
    // Optional: Add interactivity
    document.addEventListener('DOMContentLoaded', function() {
        const eventCards = document.querySelectorAll('.event-card');
        
        eventCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-lg');
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-lg');
            });
        });
    });
</script>
@endpush