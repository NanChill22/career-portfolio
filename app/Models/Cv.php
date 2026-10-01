<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cv extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'template',
        'file_path',
    ];

    /**
     * CV dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}