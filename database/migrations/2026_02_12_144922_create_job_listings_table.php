<?php

use App\Enums\Job;
use App\Enums\Job\JobStatus;
use App\Enums\Job\JobType;
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
            $table->enum('status', array_column(JobStatus::cases(), 'value'))
                ->default(JobStatus::OPEN->value);
            $table->enum('type', array_column(JobType::cases(), 'value'))
                ->default(JobType::FULLTIME->value);
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
