<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transactions extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tbl_wallet_transactions';
    protected $primaryKey = 'id_';
    public $timestamps  = false;
    protected $fillable = [
        'acronym',
        'username',
        'email',
        'transaction_id',
        'amount',
        'rrr',
        'transaction_datetime',
        'r_message',
        'r_order_id',
        'r_payment_date',
        'r_status',
        'r_transaction_time',
        'r_processor_id',
        'r_transaction_id'
    ];
}
