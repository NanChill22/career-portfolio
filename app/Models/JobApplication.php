<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    public const STATUS_APPLIED = 'applied';
    public const STATUS_REVIEW = 'review';
    public const STATUS_INTERVIEW = 'interview';
    public const STATUS_OFFERED = 'offered';
    public const STATUS_REJECTED = 'rejected';

    public const STATUSES = [
        self::STATUS_APPLIED => 'Terkirim (Applied)',
        self::STATUS_REVIEW => 'Ditinjau (In Review)',
        self::STATUS_INTERVIEW => 'Interview',
        self::STATUS_OFFERED => 'Diterima (Offered)',
        self::STATUS_REJECTED => 'Ditolak (Rejected)',
    ];

    protected $fillable = [
        'user_id',
        'cv_id',
        'cover_letter_id',
        'company_name',
        'position',
        'job_url',
        'salary_offered',
        'location',
        'applied_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'applied_date' => 'date',
    ];

    /**
     * Get human-readable status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get Tailwind badge classes for status.
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_APPLIED => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-300 dark:border-blue-700',
            self::STATUS_REVIEW => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 border border-amber-300 dark:border-amber-700',
            self::STATUS_INTERVIEW => 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300 border border-purple-300 dark:border-purple-700',
            self::STATUS_OFFERED => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700',
            self::STATUS_REJECTED => 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300 border border-rose-300 dark:border-rose-700',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    /**
     * Lamaran milik User tertentu.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * CV yang digunakan saat melamar.
     */
    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cv::class);
    }

    /**
     * Surat Lamaran yang digunakan saat melamar.
     */
    public function coverLetter(): BelongsTo
    {
        return $this->belongsTo(CoverLetter::class);
    }
}
