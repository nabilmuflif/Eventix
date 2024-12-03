@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="hero-section position-relative overflow-hidden">
    <div class="container-fluid px-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1 p-5">
                <div class="hero-content">
                    <div class="badge bg-soft-primary text-primary mb-3">
                        <i class="fas fa-music me-2"></i>World Tour 2024
                    </div>
                    <h1 class="display-4 fw-bold mb-4 text-gradient">
                        MARSHMELLO <br>WORLD TOUR
                    </h1>
                    <p class="lead text-muted mb-5">
                        Prepare for an electrifying journey through sound and emotion. 
                        Marshmello brings an unprecedented musical experience that transcends 
                        ordinary concerts. Are you ready to be part of something extraordinary?
                    </p>
                    
                    <div class="d-flex gap-3">
                        @auth
                        <a href="http://127.0.0.1:8000/event/6/booking" class="btn btn-primary btn-lg shadow-primary">
                            <i class="fas fa-ticket-alt me-2"></i>Buy Ticket
                        </a>
                    @endauth                    
                        <a href="http://127.0.0.1:8000/events/6" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Learn More
                        </a>                        
                    </div>

                    <div class="event-stats mt-5">
                        <div class="row">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h4 class="mb-0">25+</h4>
                                    <p class="text-muted mb-0">Cities</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h4 class="mb-0">100K+</h4>
                                    <p class="text-muted mb-0">Fans</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h4 class="mb-0">3</h4>
                                    <p class="text-muted mb-0">Months</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 order-1 order-lg-2 position-relative">
                <div class="hero-image-wrapper">
                    <img 
                        src="{{ asset('img/img2.png') }}" 
                        alt="Marshmello World Tour" 
                        class="img-fluid hero-image"
                    >
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section position-absolute bottom-0 start-0 end-0 py-4 bg-white shadow-sm">
        <div class="container">
            <form action="{{ route('events.search') }}" method="GET">
                <div class="input-group modern-search-input">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control border-0 shadow-none" 
                        placeholder="Search events, artists, or venues"
                        value="{{ request()->search }}"
                    >
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #6a11cb;
        --secondary-color: #2575fc;
    }

    .text-gradient {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(106,17,203,0.1), rgba(37,117,252,0.1));
    }

    .hero-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }

    .hero-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1.2);
        transition: transform 0.5s ease;
    }

    .hero-image-wrapper:hover .hero-image {
        transform: translate(-50%, -50%) scale(1.3);
    }

    .hero-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.7), transparent);
    }

    .modern-search-input {
        max-width: 800px;
        margin: 0 auto;
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .event-stats .stat-item {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
    }
</style>
@endpush

@push('scripts')
<script>
    // Optional: Add some interactive animations or effects
    document.addEventListener('DOMContentLoaded', function() {
        // Subtle parallax effect
        window.addEventListener('mousemove', function(e) {
            const heroImage = document.querySelector('.hero-image');
            const moveX = (e.clientX * -1 / 50);
            const moveY = (e.clientY * -1 / 50);
            
            heroImage.style.transform = `translate(-50%, -50%) translateX(${moveX}px) translateY(${moveY}px) scale(1.2)`;
        });
    });
</script>
@endpush


