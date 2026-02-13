<?php

use App\Enums\Job;
use App\Models\Company;
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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('departament')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', array_column(Job::cases(), 'value'))
                ->default(Job::OPEN->value);
            $table->enum('type', array_column(Job::cases(), 'value'))
                ->default(Job::FULLTIME->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
