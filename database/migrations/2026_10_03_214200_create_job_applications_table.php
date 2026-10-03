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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('cv_id')
                ->nullable()
                ->constrained('cvs')
                ->nullOnDelete();

            $table->foreignId('cover_letter_id')
                ->nullable()
                ->constrained('cover_letters')
                ->nullOnDelete();

            $table->string('company_name');
            $table->string('position');
            $table->string('job_url')->nullable();
            $table->string('salary_offered')->nullable();
            $table->string('location')->nullable(); // Remote / On-site / Hybrid / Kota
            $table->date('applied_date');
            $table->string('status')->default('applied'); // applied, review, interview, offered, rejected
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
