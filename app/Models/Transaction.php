<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['items'];
    protected $table = "transactions";
    protected $primaryKey = 'id';
    protected $fillable = [
        'users_id', 'total_price', 'money', 'change', 'payment_method', 'status_transactions', 'order_type', 'transfer_proof'
    ];

    protected $with = ['user', 'items'];

    protected $cast = [
        'total_price' => 'integer',
        'money' => 'integer',
        'change' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }
}
