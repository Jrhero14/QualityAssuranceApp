<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'shift1_id',
        'shift2_id'
    ];


    public function checkings()
    {
        return $this->hasMany(Checking::class);
    }

    public function shift1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shift1_id', 'id');
    }

    public function shift2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shift2_id', 'id');
    }
}
