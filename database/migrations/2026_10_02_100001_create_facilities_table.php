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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();       // id fasilitas di frontend, mis. "fac-lab-pemweb"
            $table->string('name');
            $table->string('type');
            $table->string('location');
            $table->string('room');
            $table->unsignedInteger('capacity');
            $table->string('pic')->nullable();
            $table->string('banner_class')->nullable();
            $table->text('description')->nullable();
            $table->json('equipment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
