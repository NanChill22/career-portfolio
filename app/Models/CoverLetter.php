<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoverLetter extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'company',
        'position',
        'content',
        'file_path',
    ];

    /**
     * Cover letter dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}