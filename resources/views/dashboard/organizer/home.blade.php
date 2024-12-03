@extends('layouts.master')

@section('content')
<div class="container-fluid px-4 dashboard-full-height">
    <div class="row">
        <div class="col-12">
            <div class="page-header text-center mb-5">
                <h1 class="display-4 text-primary font-weight-bold">
                    Organizer Dashboard
                </h1>
                <p class="lead text-muted">
                    Pusat Kendali Utama Manajemen Sistem
                </p>
            </div>
        </div>
    </div>

    <div class="row dashboard-cards">
        <!-- Events Management Card -->
        <div class="col-md-6 mb-6">
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
                                <span class="text-primary ml-2">24</span>
                            </div>
                            <div>
                                <strong>Aktif</strong>
                                <span class="text-success ml-2">12</span>
                            </div>
                        </div>
                        <a href="{{ route('organizer.events') }}" class="btn btn-primary btn-block">
                            Kelola Event
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Ticket Management Card -->
        <div class="col-md-6 mb-6">
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
                        <div class="card-stats d-flex justify-content-between mb-3">
                            <div>
                                <strong>Total Tiket</strong>
                                <span class="text-primary ml-2">1,200</span>
                            </div>
                            <div>
                                <strong>Terjual</strong>
                                <span class="text-success ml-2">850</span>
                            </div>
                        </div>
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

