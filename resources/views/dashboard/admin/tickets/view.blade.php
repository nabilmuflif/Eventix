@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-4">
                        <i class="fas fa-ticket-alt fa-3x"></i>
                    </div>
                    <div>
                        <h2 class="card-title mb-2">Manajemen Tiket: {{ $event->name }}</h2>
                        <p class="card-text opacity-8">
                            Kelola dan pantau semua booking tiket untuk event ini
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Daftar Booking Tiket</h3>
                        </div>
                        <div class="col text-right">
                            <div class="badge badge-primary badge-pill">
                                Total Booking: {{ $bookings->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($bookings->isEmpty())
                    <div class="card-body text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            Belum ada booking untuk event ini.
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID Booking</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold text-dark">
                                                {{ $booking->id }}
                                            </span>
                                        </td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->user->email }}</td>
                                        <td>
                                            @switch($booking->status)
                                                @case('approved')
                                                    <span class="badge badge-success text-dark">Disetujui</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge badge-danger text-dark">Dibatalkan</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-warning text-dark">Menunggu</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if($booking->status != 'approved')
                                                    <a href="{{ route('admin.tickets.approve', $booking->id) }}" 
                                                       class="btn btn-success btn-sm mr-2"
                                                       onclick="return confirm('Yakin ingin menyetujui booking ini?')">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </a>
                                                @endif

                                                @if($booking->status != 'cancelled')
                                                    <a href="{{ route('admin.tickets.cancel', $booking->id) }}" 
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                                        <i class="fas fa-times"></i> Batalkan
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(to right, #5e72e4, #825ee4) !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
</style>
@endpush