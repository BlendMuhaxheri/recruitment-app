<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'job_listings';

    protected $fillable = [
        'company_id',
        'title',
        'departament',
        'location',
        'status',
        'type'
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
