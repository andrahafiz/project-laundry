<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CatatanToko extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "catatan_tokos";
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'keterangan', 'image', 'tanggal'
    ];
    protected $dates = ['tanggal'];
}
