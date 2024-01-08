<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = "feedbacks";
    protected $primaryKey = 'id';
    protected $fillable = ['customer_name', 'transactions_id', 'user_id', 'nohp_customer', 'code', 'jawaban1', 'jawaban2', 'jawaban3', 'jawaban4', 'jawaban5', 'expired'];
    public $with = ['transaction', 'user'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
