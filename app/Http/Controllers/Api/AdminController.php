<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Company;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Affiliate;
use App\Models\Log;
use \Auth, Mail;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        return Company::take(2)->get();
    }
}
