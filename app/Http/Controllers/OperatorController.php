<?php

namespace App\Http\Controllers;

use App\Models\InformasiAsetKritis;
use App\Models\KategoriAsetKritis;
use App\Models\PersyaratanKeamanan;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function manageAssetCategories()
    {
        return view('operator.kategori-aset');
    }

    public function storeAssetCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        KategoriAsetKritis::create([
            'name' => $request->name
        ]);

        return redirect()->route('operator.asset.categories')->with('success', 'Asset Category Created 😍!');
    }

    public function updateAssetCategory(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = KategoriAsetKritis::find($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('operator.asset.categories')->with('success', 'Asset Category Updated 😍!');
    }

    public function deleteAssetCategory($id)
    {
        $category = KategoriAsetKritis::find($id);
        $category->delete();

        return redirect()->route('operator.asset.categories')->with('success', 'Asset Category Deleted 😍!');
    }

    
    // ASSETS
    public function manageAssets()
    {
        return view('operator.aset-kritis')->with('categories', KategoriAsetKritis::all());
    }

    public function storeAsset(Request $request)
    {
        $aset = InformasiAsetKritis::create([
            'id_kategori' => $request->id_kategori,
            'name' => $request->name,
            'deskripsi' => $request->deskripsi
        ]);
        PersyaratanKeamanan::create([
            'id_aset' => $aset->id
        ]);

        return redirect()->route('operator.assets')->with('success', 'Asset Created 😍!');
    }

    public function updateAsset(Request $request, $id)
    {
        $aset = InformasiAsetKritis::find($id);
        $aset->update([
            'id_kategori' => $request->id_kategori,
            'name' => $request->name,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('operator.assets')->with('success', 'Asset Updated 😍!');
    }

    public function deleteAsset($id)
    {
        $asset = InformasiAsetKritis::find($id);
        $asset->delete();

        return redirect()->route('operator.assets')->with('success', 'Asset Deleted 😍!');
    }

    
    // SECURITY REQUIREMENTS
    public function manageSecurityRequirements()
    {
        return view('operator.persyaratan-keamanan');
    }

    public function storeSecurityRequirement(Request $request)
    {
        PersyaratanKeamanan::create([
            'id_aset' => $request->id_aset,
            'jenis' => $request->jenis,
            'kebutuhan' => $request->kebutuhan
        ]);

        return redirect()->route('operator.security.requirements')->with('success', 'Security Requirement Created 😍!');
    }

    public function updateSecurityRequirement(Request $request, $id)
    {
        $requirement = PersyaratanKeamanan::find($id);
        $requirement->update([
            'jenis' => $request->jenis,
            'kebutuhan' => $request->kebutuhan
        ]);

        return redirect()->route('operator.security.requirements')->with('success', 'Security Requirement Updated 😍!');
    }

    public function deleteSecurityRequirement($id)
    {
        $category = PersyaratanKeamanan::find($id);
        $category->delete();

        return redirect()->route('operator.security.requirements')->with('success', 'Security Requirement Deleted 😍!');
    }
}
