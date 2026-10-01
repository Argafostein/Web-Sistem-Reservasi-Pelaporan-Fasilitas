<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->timestamp('rejected_at')
                ->nullable()
                ->after('resolved_at');

            $table->text('resolution_note')
                ->nullable()
                ->after('rejected_at');

        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropColumn([
                'rejected_at',
                'resolution_note',
            ]);

        });
    }
};