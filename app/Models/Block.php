<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_id',
        'starts_at',
        'ends_at',
    ];

    public $timestamps = false;

    /**
     * Belongs To Room
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
