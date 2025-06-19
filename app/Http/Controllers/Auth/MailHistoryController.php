<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailHistoryController extends Controller
{
    public function index($id)
    {   

        return view('auth.index');
    }

}
