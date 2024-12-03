@extends('layouts.event')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card event-detail-card shadow-lg border-0">
                <!-- Event Image Section -->
                <div class="event-image-container position-relative">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" 
                             class="card-img-top event-image" 
                             alt="{{ $event->name }}">
                    @else
                        <img src="https://via.placeholder.com/1200x600" 
                             class="card-img-top event-image" 
                             alt="Default Event Image">
                    @endif
                    
                    <!-- Overlay dengan informasi singkat -->
                    <div class="event-image-overlay">
                        <div class="overlay-content">
                            <h1 class="event-title text-white">{{ $event->name }}</h1>
                            <div class="event-meta">
                                <span class="badge badge-primary mr-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </span>
                                <span class="badge badge-info">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ $event->location }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Details Section -->
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="section-title mb-3"></h3>
                            <p class="event-description">
                                {{ $event->description }}
                            </p>

                            <div class="event-additional-info mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <h5 class="info-title">
                                                <i class="fas fa-ticket-alt text-primary mr-2"></i>Harga Tiket
                                            </h5>
                                            <p class="info-text font-weight-bold text-success">
                                                Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <h5 class="info-title">
                                                <i class="fas fa-users text-info mr-2"></i>Kuota Tersedia
                                            </h5>
                                            <p class="info-text font-weight-bold text-warning">
                                                {{ $event->ticket_quota }} Tiket
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons Section -->
                        <div class="col-md-4">
                            <div class="event-actions card bg-light p-3">
                                <div class="btn-group-vertical">
                                    @if(Auth::check())
                                    <form action="{{ route('event.favorite.toggle', $event->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        @if(Auth::user()->favorites()->where('event_id', $event->id)->exists())
                                            <button type="submit" class="btn btn-outline-danger btn-block">
                                                <i class="fas fa-heart mr-2"></i>Hapus dari Favorit
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-outline-primary btn-block">
                                                <i class="far fa-heart mr-2"></i>Tambah ke Favorit
                                            </button>
                                        @endif
                                    </form>
                                @endif

                                    <!-- Tombol Pesan Tiket -->
                                    @if(Auth::check())
                                        <a href="{{ route('event.booking.form', $event->id) }}" 
                                           class="btn btn-primary btn-block mb-2">
                                            <i class="fas fa-shopping-cart mr-2"></i>Pesan Tiket
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="btn btn-success btn-block mb-2">
                                            <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Pesan
                                        </a>
                                    @endif

                                    <a href="{{ route('events.catalog') }}" 
                                       class="btn btn-outline-secondary btn-block">
                                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Katalog
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .event-detail-card {
        border-radius: 15px;
        overflow: hidden;
    }

    .event-image-container {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .event-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .event-image-container:hover .event-image {
        transform: scale(1.05);
    }

    .event-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        color: white;
    }

    .event-meta .badge {
        font-size: 0.9rem;
    }

    .info-item {
        background-color: #f8f9fe;
        padding: 15px;
        border-radius: 10px;
    }
</style>
@endpush