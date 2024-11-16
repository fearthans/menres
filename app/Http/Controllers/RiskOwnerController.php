<?php

namespace App\Http\Controllers;

use App\Models\InformasiAsetKritis;
use App\Models\PersyaratanKeamanan;
use App\Models\Risiko;
use Illuminate\Http\Request;

class RiskOwnerController extends Controller
{
    public function dashboard()
    {
        $jumlahAsset = InformasiAsetKritis::count();
        $persentasePerBulan = InformasiAsetKritis::getMonthlyPercentageChange();
        $dibuat = InformasiAsetKritis::getRangeDateCreated();

        return view('risk_owner.dashboard')->with('riskItems', [
            'total' => $jumlahAsset,
            'lastMonth' => $persentasePerBulan,
            'timeRange' => $dibuat,
            'asetCateogry' => InformasiAsetKritis::getCountAssetByCategory(),
            'persyaratanKeamanan' => PersyaratanKeamanan::getSecurityRequirementAssetCounts(),
            'risikos' => Risiko::getRisksOrderByAsset(),
        ]);
    }
    public function analyzeRisk()
    {
        return view('risk_owner.analisis-risiko')->with('datas', [
            'risikos' => Risiko::getRisksOrderByAsset(), // pilihan aset tersedia dan kode sesuai
            'assets' => InformasiAsetKritis::all() // pilihan semau aset
        ]);
    }

    public function storeAnalyzeRisk(Request $request)
    {
        // [
        //     'kode' => 'R5.3',
        //     'id_aset' => 4,
        //     'kerentanan' => 'Jalur komunikasi yang tidak terlindungi (tidak ada kebijakan izin pemutusan kabel dan ganti rugi yang jelas ke pihak UPT. TIK XYZ)',
        //     'ancaman' => 'Rugi secara finansial, waktu, tenaga dalam perbaikan infrastruktur yang hancur',
        //     'potensi_sebab' => 'Pembangunan yang Memutuskan kabel tanpa izin yang jelas',
        //     'potensi_efek' => 'Kerugian Secara Finansial, waktu, tenaga dalam perbaikan infrastruktur yang hancur',
        //     'severity' => 7,
        //     'occurrence' => 8,
        //     'detection' => 5,
        // ],
        $validate = $request->validate([
            'kode' => 'required|unique:risikos,kode,' . $request->kode,
        ]);
        if (!$validate) {
            return redirect()->back()->with('error', 'Kode Risiko Sudah Ada');
        }

        Risiko::create([
            'kode' => $request->kode,
            'id_aset' => $request->id_aset,
            'kerentanan' => $request->kerentanan,
            'ancaman' => $request->ancaman,
            'potensi_sebab' => $request->potensi_sebab,
            'potensi_efek' => $request->potensi_efek,
            'severity' => $request->severity,
            'occurrence' => $request->occurrence,
            'detection' => $request->detection
        ]);
        // route('risk.owner.analyze');
        return redirect()->back()->with('success', 'Analyze Risk Created 😍!');
    }

    public function updateAnalyzeRisk(Request $request, $id)
    {

        $risk = Risiko::find($id);
        $risk->update([
            'kode' => $request->kode,
            'id_aset' => $request->id_aset,
            'kerentanan' => $request->kerentanan,
            'ancaman' => $request->ancaman,
            'potensi_sebab' => $request->potensi_sebab,
            'potensi_efek' => $request->potensi_efek,
            'severity' => $request->severity,
            'occurrence' => $request->occurrence,
            'detection' => $request->detection
        ]);

        return redirect()->back()->with('success', 'Analyze Risk Updated 😍!');
    }

    public function deleteAnalyzeRisk($id)
    {

        $risk = Risiko::find($id)->delete();
        // return redirect()->route('admin.users')->with('success', 'User Deleted 😍!');
        return redirect()->back()->with('success', 'Analyze Risk Deleted 😍!');
    }

    public function evaluateRisk()
    {
        $risikos = Risiko::all();
        $risikos->map(function ($risiko) {
            $rpn = $risiko->severity * $risiko->occurrence * $risiko->detection;
            $kategori = $rpn > 210 ? 'very high' : ($rpn > 150 ? 'high' : ($rpn > 80 ? 'medium' : ($rpn > 20 ? 'low' : 'very low')));
            $risiko->rpn = $rpn;
            $risiko->kategori = $kategori;
        });

        return view('risk_owner.evaluasi-risiko')->with('risikos', $risikos);
    }

    public function manageMitigation()
    {
        return view('risk_owner.kelola-mitigasi')->with('risikos', Risiko::select('id', 'kode', 'ancaman', 'mitigation')->get());
    }

    public function storeManageMitigation(Request $request)
    {
        $risk = Risiko::where('kode', $request->kode)->first();
        $check = $risk->update([
            'mitigation' => $request->mitigation,
            'mitigation_date' => date('Y-m-d H:i:s')
        ]);

        if (!$check) {
            return redirect()->back()->with('error', 'Mitigation Risk Failed to Added 😤!');
        }

        return redirect()->back()->with('success', 'Mitigation Risk Added 😍!');
    }

    public function updateManageMitigation(Request $request)
    {
        $risk = Risiko::find($request->id);
        $risk->update([
            'mitigation' => $request->mitigation,
            'mitigation_date' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Mitigation Risk Updated 😍!');
    }

    public function deleteManageMitigation($id)
    {
        Risiko::find($id)->delete();
        return redirect()->back()->with('success', 'Mitigation Risk Deleted 😍!');
    }
}
