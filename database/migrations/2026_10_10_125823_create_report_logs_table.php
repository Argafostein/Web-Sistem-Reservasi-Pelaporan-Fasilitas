
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('report_logs')) {
            return;
        }

        Schema::create('report_logs', function (Blueprint $table) {
            $table->id('report_log_id');

            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('action');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->text('note')->nullable();

            $table->timestamps();

            $table->foreign('report_id')
                ->references('report_id')
                ->on('reports')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->nullOnDelete();

            $table->index(['report_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_logs');
    }
};
