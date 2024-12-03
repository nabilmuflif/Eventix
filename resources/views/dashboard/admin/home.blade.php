@extends('layouts.master')

@section('content')
<div class="container-fluid px-4 dashboard-full-height">
    <div class="row">
        <div class="col-12">
            <div class="page-header text-center mb-5">
                <h1 class="display-4 text-primary font-weight-bold">
                    Admin Dashboard
                </h1>
                <p class="lead text-muted">
                    Pusat Kendali Utama Manajemen Sistem
                </p>
            </div>
        </div>
    </div>

    <div class="row dashboard-cards">
        <!-- Events Management Card -->
        <div class="col-md-4 mb-4">
            <div class="card card-square card-tall card-lift--hover shadow-lg border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="icon-shape icon-shape-primary rounded-circle mb-4 align-self-center">
                        <i class="fas fa-calendar-alt fa-4x text-white"></i>
                    </div>
                    <h3 class="h3 mb-3 font-weight-bold">Manajemen Event</h3>
                    <p class="description text-muted flex-grow-1">
                        Kelola seluruh event secara komprehensif. Tambah, edit, 
                        hapus, dan monitor event dengan antarmuka yang intuitif. 
                        Pantau statistik, peserta, dan detail event secara real-time.
                    </p>
                    <div class="mt-auto">
                        <div class="card-stats d-flex justify-content-between mb-3">
                            <div>
                                <strong>Total Event</strong>
                                <span class="text-primary ml-2">{{ $totalevent }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.events') }}" class="btn btn-primary btn-block">
                            Kelola Event
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Management Card -->
        <div class="col-md-4 mb-4">
            <div class="card card-square card-tall card-lift--hover shadow-lg border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="icon-shape icon-shape-success rounded-circle mb-4 align-self-center">
                        <i class="fas fa-users fa-4x text-white"></i>
                    </div>
                    <h3 class="h3 mb-3 font-weight-bold">Manajemen Pengguna</h3>
                    <p class="description text-muted flex-grow-1">
                        Kontrol akses pengguna secara menyeluruh. Atur hak akses, 
                        monitor aktivitas, dan kelola profil dengan sistem keamanan 
                        yang canggih dan mudah digunakan.
                    </p>
                    <div class="mt-auto">
                        <div class="card-stats d-flex justify-content-between mb-3">
                            <div>
                                <strong>Total Pengguna</strong>
                                <span class="text-primary ml-2">{{ $totalUsers }}</span>
                            </div>                            
                        </div>
                        <a href="{{ route('admin.users') }}" class="btn btn-success btn-block">
                            Kelola Pengguna
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Management Card -->
        <div class="col-md-4 mb-4">
            <div class="card card-square card-tall card-lift--hover shadow-lg border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="icon-shape icon-shape-info rounded-circle mb-4 align-self-center">
                        <i class="fas fa-ticket-alt fa-4x text-white"></i>
                    </div>
                    <h3 class="h3 mb-3 font-weight-bold">Manajemen Tiket</h3>
                    <p class="description text-muted flex-grow-1">
                        Sistem manajemen tiket canggih. Lacak penjualan, 
                        konfirmasi kehadiran, dan kelola distribusi tiket 
                        dengan sistem pelaporan yang komprehensif.
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('admin.tickets.view', ['event' => $event->id]) }}" class="btn btn-info btn-block">
                            Kelola Tiket
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Full Height Dashboard */
    html, body {
        height: 100%;
    }

    .dashboard-full-height {
        min-height: calc(100vh - 100px); /* Sesuaikan dengan tinggi header/navbar */
        display: flex;
        flex-direction: column;
    }

    .dashboard-cards {
        flex-grow: 1;
    }

    /* Card Styles */
    .card-tall {
        min-height: 500px;
        display: flex;
        flex-direction: column;
    }

    .card-square {
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .card-square .icon-shape {
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-square .icon-shape-primary {
        background: linear-gradient(45deg, #5e72e4, #825ee4);
    }

    .card-square .icon-shape-success {
        background: linear-gradient(45deg, #2dce89, #2dcecc);
    }

    .card-square .icon-shape-info {
        background: linear-gradient(45deg, #11cdef, #1171ef);
    }

    .card-stats {
        background-color: #f6f9fc;
        padding: 10px;
        border-radius: 10px;
    }

    .card-lift--hover:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card-tall {
            min-height: auto;
        }
    }
</style>
@endpush