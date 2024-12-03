@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow-lg border-0">
                <!-- Header Event -->
                <div class="card-header bg-gradient-primary text-black">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <i class="fas fa-ticket-alt fa-3x"></i>
                        </div>
                        <div>
                            <h2 class="card-title mb-1">Pemesanan Tiket</h2>
                        </div>
                    </div>
                </div>

                <!-- Body Pemesanan -->
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Event -->
                        <div class="col-md-6">
                            <h4 class="mb-4">Detail Event</h4>
                            <div class="event-details">
                                <div class="detail-item mb-3">
                                    <h5>
                                        <i class="fas fa-calendar-alt text-primary mr-2"></i>Tanggal
                                    </h5>
                                    <p class="text-muted">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                    </p>
                                </div>

                                <div class="detail-item mb-3">
                                    <h5>
                                        <i class="fas fa-map-marker-alt text-info mr-2"></i>Lokasi
                                    </h5>
                                    <p class="text-muted">{{ $event->location }}</p>
                                </div>

                                <div class="detail-item mb-3">
                                    <h5>
                                        <i class="fas fa-money-bill-wave text-success mr-2"></i>Harga Tiket
                                    </h5>
                                    <p class="text-muted font-weight-bold">
                                        Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="detail-item mb-3">
                                    <h5>
                                        <i class="fas fa-chart-pie text-warning mr-2"></i>Kuota Tersisa
                                    </h5>
                                    <p class="text-muted">
                                        {{ $event->ticket_quota }} Tiket
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Pemesanan -->
                        <div class="col-md-6">
                            <h4 class="mb-4">Form Pemesanan</h4>
                            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                
                                <div class="form-group">
                                    <label for="quantity">Jumlah Tiket</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-ticket-alt"></i>
                                            </span>
                                        </div>
                                        <input type="number" 
                                               id="quantity" 
                                               name="quantity" 
                                               class="form-control" 
                                               min="1" 
                                               max="{{ $event->ticket_quota }}" 
                                               required
                                               placeholder="Masukkan jumlah tiket">
                                    </div>
                                    <small class="form-text text-muted">
                                        Maks. {{ $event->ticket_quota }} tiket tersedia
                                    </small>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-shopping-cart mr-2"></i>Konfirmasi Pemesanan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer">
                    <a href="{{ route('events.catalog') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const ticketPrice = {{ $event->ticket_price }};
        const maxTickets = {{ $event->ticket_quota }};

        $('#quantity').on('input', function() {
            const quantity = $(this).val();
            const totalPrice = quantity * ticketPrice;
            
            $('#totalPrice').val(new Intl.NumberFormat('id-ID').format(totalPrice));

            // Validasi jumlah tiket
            if (quantity > maxTickets) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: `Jumlah tiket melebihi kuota tersedia (${maxTickets} tiket)`
                });
                $(this).val(maxTickets);
            }
        });

        $('#bookingForm').on('submit', function(e) {
            const quantity = $('#quantity').val();
            
            if (quantity < 1) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Jumlah tiket minimal 1'
                });
            }
        });
    });
</script>
@endpush

@push('styles')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(to right, #5e72e4, #825ee4) !important;
        }

        .event-details .detail-item {
            background-color: #f8f9fe;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .event-details .detail-item h5 {
            margin-bottom: 10px;
            color: #32325d;
        }

        .container-fluid{
            width: 100%;
            height: 00vh;
            padding: 100px
        }
    </style>
@endpush