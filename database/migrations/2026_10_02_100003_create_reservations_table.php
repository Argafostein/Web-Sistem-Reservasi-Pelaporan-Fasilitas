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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();       // kode reservasi, mis. "RES-2026-00412"
            $table->foreignId('facility_id')->nullable()->constrained('facilities')->nullOnDelete();
            $table->string('facility_name')->nullable();
            $table->string('facility_type')->nullable();
            $table->string('location')->nullable();
            $table->string('date_label')->nullable();       // label tanggal tampilan, mis. "Kamis, 01 Okt 2026"
            $table->string('slot_time', 30)->nullable();
            $table->string('purpose')->nullable();
            $table->string('applicant')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('status', 30)->default('Disetujui'); // Disetujui | Menunggu Konfirmasi | Selesai | Dibatalkan
            $table->string('applied_at_label')->nullable();     // mis. "30 Sep 2026, 14:20 WIB"
            $table->string('approved_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
