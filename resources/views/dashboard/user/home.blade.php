@extends('layouts.master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg mb-4 border-0">
                <div class="card-header bg-gradient-primary text-white text-center py-4">
                    <h3 class="card-title mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Bergabung</small>
                            <strong>{{ Auth::user()->created_at->format('d M Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Status</small>
                            <span class="badge 
                                @switch(Auth::user()->role)
                                    @case('admin') badge-danger @break
                                    @case('event_organizer') badge-warning @break
                                    @default badge-info
                                @endswitch
                            ">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-gradient-success text-black">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-heart mr-2"></i>Event Favorit Anda
                    </h4>
                </div>
                <div class="card-body">
                    @php
                        $favorites = Auth::user()->favorites;
                    @endphp

                    @if($favorites->isEmpty())
                        <div class="alert alert-info text-center" role="alert">
                            <i class="fas fa-info-circle mr-2"></i>
                            Anda belum memiliki event favorit
                        </div>
                    @else
                        <div class="row">
                            @foreach($favorites as $favorite)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 favorite-event-card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $favorite->name }}</h6>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-calendar mr-2"></i>
                                                {{ 
                                                    $favorite->event_date instanceof \Carbon\Carbon 
                                                    ? $favorite->event_date->format('d M Y') 
                                                    : (is_string($favorite->event_date) 
                                                        ? \Carbon\Carbon::parse($favorite->event_date)->format('d M Y') 
                                                        : 'Tanggal tidak tersedia') 
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-4">
        <a href="{{ route('user.booking-history') }}" class="btn btn-primary">
            <i class="fas fa-history mr-2"></i>Riwayat Booking
        </a>
    </div>

    <div class="text-right mt-4">
        <a href="{{ route('user.profile') }}" class="btn btn-primary">
            <i class="mr-2"></i>Profile edit
        </a>
    </div>
</div>
@endsection
