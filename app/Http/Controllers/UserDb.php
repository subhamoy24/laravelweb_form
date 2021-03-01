<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserDb extends Controller
{
    function index(){
    	return DB::select("select * from users");

    }
}
