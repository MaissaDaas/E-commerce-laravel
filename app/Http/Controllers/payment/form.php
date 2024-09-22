<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class form extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.success');
    }
}
