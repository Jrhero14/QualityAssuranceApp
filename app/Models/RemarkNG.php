<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkNG extends Model
{
    /** @use HasFactory<\Database\Factories\RemarkNGFactory> */
    use HasFactory;

    protected $fillable = [
        'checking_id',
        'SLVR',
        'BRY',
        'GLS',
        'FWBK',
        'BNG_RNR',
        'SNMRK',
        'STRATCH',
        'SHOT_MOLD'
    ];


    public function checking()
    {
        return $this->belongsTo(RemarkNG::class);
    }
}
