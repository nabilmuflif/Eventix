@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-4">
                        <i class="fas fa-calendar-alt fa-3x"></i>
                    </div>
                    <div>
                        <h2 class="card-title mb-2">Manajemen Event</h2>
                        <p class="card-text opacity-8">
                            Kelola dan pantau semua event yang tersedia
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow-lg border-0">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Daftar Event</h3>
                        </div>
                        <div class="col text-right">
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus mr-2"></i>Buat Event Baru
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Event</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Harga Tiket</th>
                                <th>Kuota Tiket</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td class="font-weight-bold text-dark">{{ $event->name }}</td>
                                    <td>{{ Str::limit($event->description, 50) }}</td>
                                    <td>
                                        <span class="font-weight-bold text-primary mr-3">
                                            <i class="bg-success"></i>
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td>{{ $event->location }}</td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary
                                            {{ $event->ticket_quota > 50 ? 'badge-success' : 'badge-warning' }}">
                                            {{ $event->ticket_quota }} Tiket
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.events.edit', $event->id) }}" 
                                               class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.events.delete', $event->id) }}" 
                                                  method="POST" 
                                                  class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Tidak ada event yang tersedia
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('.delete-form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Event akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(to right, #5e72e4, #825ee4) !important;
    }
</style>
@endpush
