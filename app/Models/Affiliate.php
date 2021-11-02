<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Affiliate extends Model
{
    use HasFactory,Notifiable;
    protected $connection = 'sqlsrv';
    protected $table = 'affiliates';
    protected $primaryKey = 'id';
}
