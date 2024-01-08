<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modal extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "modals";
    protected $primaryKey = 'id';
    protected $fillable = ['modal_awal', 'laba_bersih', 'periode', 'modal_akhir'];
    protected $casts = [
        'periode' => 'date',
    ];
}
