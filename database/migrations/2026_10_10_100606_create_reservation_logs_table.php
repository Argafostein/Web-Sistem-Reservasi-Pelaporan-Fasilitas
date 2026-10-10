<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_logs', function (Blueprint $table) {
            $table->id('log_id');

            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('action', 30);
            $table->text('reason')->nullable();

            $table->timestamps();

            $table->foreign('reservation_id')
                ->references('reservation_id')
                ->on('reservations')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_logs');
    }
};
