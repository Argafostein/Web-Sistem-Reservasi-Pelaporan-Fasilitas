<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');

            // User yang melakukan reservasi
            $table->unsignedBigInteger('user_id');

            // Fasilitas yang dipesan
            $table->unsignedBigInteger('facility_id');

            // Detail reservasi
            $table->date('reservation_date');
            $table->time('start_time');
            $table->time('end_time');

            // Keperluan reservasi
            $table->string('purpose');

            // Status reservasi
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'cancelled'
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('facility_id')
                ->references('facility_id')
                ->on('facilities')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};