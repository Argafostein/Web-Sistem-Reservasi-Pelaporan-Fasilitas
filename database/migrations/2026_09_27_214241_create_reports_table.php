<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {

            $table->id('report_id');

            // User yang membuat laporan
            $table->unsignedBigInteger('user_id');

            // Fasilitas yang dilaporkan
            $table->unsignedBigInteger('facility_id');

            // Kategori laporan
            $table->string('category');

            // Judul laporan
            $table->string('title');

            // Penjelasan masalah
            $table->text('description');

            // Foto bukti (opsional)
            $table->string('image')->nullable();

            // Status laporan
            $table->enum('status', [
                'pending',
                'processing',
                'resolved',
                'rejected'
            ])->default('pending');

            // Catatan dari admin
            $table->text('admin_note')->nullable();

            $table->timestamps();


            // Relasi ke users
            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');


            // Relasi ke facilities
            $table->foreign('facility_id')
                ->references('facility_id')
                ->on('facilities')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};