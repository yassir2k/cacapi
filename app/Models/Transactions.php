<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transactions extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tbl_wallet_transactions';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [
        'username',
        'email',
        'amount',
        'rrr',
        'description',
        'r_message',
        'r_order_id',
        'r_payment_date',
        'r_status',
        'r_processor_id',
        'r_transaction_id'
    ];
}
