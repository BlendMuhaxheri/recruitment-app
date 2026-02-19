<?php

use App\Enums\Application\ApplicationStage;
use App\Models\Candidate;
use App\Models\Job;
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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Candidate::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Job::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('application_stage')
                ->default(ApplicationStage::Applied->value);

            $table->timestamps();

            $table->unique(['candidate_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
