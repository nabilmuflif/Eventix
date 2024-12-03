<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat tabel events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama event
            $table->text('description'); // Deskripsi event
            $table->date('event_date'); // Tanggal event
            $table->timestamp('date_time')->nullable(); // Waktu event (opsional)
            $table->string('location'); // Lokasi event
            $table->decimal('ticket_price', 8, 2); // Harga tiket
            $table->integer('ticket_quota'); // Kuota tiket
            $table->string('image')->nullable(); // Gambar event (opsional)
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Foreign key ke tabel users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel events jika ada rollback
        Schema::dropIfExists('events');
    }
};                                                                                  
