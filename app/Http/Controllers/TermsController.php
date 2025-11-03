<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    // General Terms
    public function index()
    {
        return view('terms.terms-and-conditions');
    }

    // Flydreamz
    public function flydreamzRefundable()
    {
        return view('terms.flydreamz_refundable');
    }

    public function flydreamzNonRefundable()
    {
        return view('terms.flydreamz_nonrefundable');
    }

    // FareticketsUS
    public function fareticketsusRefundable()
    {
        return view('terms.fareticketsus_refundable');
    }

    public function fareticketsusNonRefundable()
    {
        return view('terms.fareticketsus_nonrefundable');
    }
}
