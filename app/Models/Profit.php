<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profit extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "profits";
    protected $primaryKey = 'id';
    protected $fillable = ['penjualan_bersih', 'sewa_ruko', 'beban_lain', 'beban_air', 'beban_listrik', 'beban_gaji', 'total_beban', 'pajak', 'laba_bersih', 'periode'];
    protected $casts = [
        'periode' => 'date',
    ];
}
