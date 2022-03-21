<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Log extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_api_log';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [
        'transaction_id',
        'details',
        'api_call_datetime',
        'ip_address',
        'device',
        'browser',
        'operating_system',
        'call_type',
        'api_call_cost',
        'response_code',
        'acronym',
        'username',
        'email'
    ];
}
