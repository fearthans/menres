<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiskController extends Controller
{
    public function showRiskProfile(){
        return view('kepala_upt.risk-profile');
    }
}
