<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checking extends Model
{
    /** @use HasFactory<\Database\Factories\CheckingFactory> */
    use HasFactory;

    protected $fillable = [
        'item_id',
        'schedule_id',
        'part_no',
        'OK',
        'NG',
        'total',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }


    public function remarkNG()
    {
        return $this->hasOne(RemarkNG::class);
    }
}
