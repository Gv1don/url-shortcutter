<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Click extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'short_link_id',
        'ip_address',
        'user_agent',
    ];

    public function shortLink(): BelongsTo
    {
        return $this->belongsTo(ShortLink::class);
    }
}
