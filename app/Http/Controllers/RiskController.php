<?php

namespace App\Http\Controllers;

use App\Models\Risiko;
use Illuminate\Http\Request;

class RiskController extends Controller
{
    public function showRiskProfile(){
        $risikos = Risiko::all();
        $risikos->map(function ($risiko) {
            $rpn = $risiko->severity * $risiko->occurrence * $risiko->detection;
            $kategori = $rpn > 210 ? 'very high' : ($rpn > 150 ? 'high' : ($rpn > 80 ? 'medium' : ($rpn > 20 ? 'low' : 'very low')));
            $risiko->rpn = $rpn;
            $risiko->kategori = $kategori;
        });
        // <th class="border-0">#</th>
        //                         <th class="border-0">Kode</th>
        //                         <th class="border-0">Ancaman</th>
        //                         <th class="border-0">Pontential Cause</th>
        //                         <th class="border-0">Pontential Effects</th>
        //                         <th class="border-0">Severity</th>
        //                         <th class="border-0">Occurrence</th>
        //                         <th class="border-0">Detection</th>
        //                         <th class="border-0">RPN</th>
        //                         <th class="border-0">Level</th>
        return view('kepala_upt.risk-profile')->with('risikos', $risikos);
    }
}
