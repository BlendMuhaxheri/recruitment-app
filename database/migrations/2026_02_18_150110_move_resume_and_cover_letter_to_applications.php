<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('resume_path')->nullable()->after('candidate_id');
            $table->text('cover_letter')->nullable()->after('resume_path');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn(['resume_path', 'cover_letter']);
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('resume_path')->nullable();
            $table->text('cover_letter')->nullable();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['resume_path', 'cover_letter']);
        });
    }
};
