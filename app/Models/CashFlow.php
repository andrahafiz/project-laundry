<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashFlow extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "cashflows";
    protected $primaryKey = 'id';
    protected $fillable = ['no_akun', 'tanggal', 'keterangan', 'pemasukan', 'pengeluaran'];
    protected $casts = [
        'tanggal' => 'date',
    ];
}
