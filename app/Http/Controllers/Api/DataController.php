<?php

namespace App\Http\Controllers\Api;

use App\Models\InformasiAsetKritis;
use App\Models\KategoriAsetKritis;
use App\Models\PersyaratanKeamanan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Risiko;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DataController extends Controller
{
    public function rolesBig()
    {
        $roles = Role::all();

        return datatables()->of($roles)
            ->addColumn('action', 'admin.components.roles-button-big')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function rolesSmall()
    {
        $roles = Role::all();

        return datatables()->of($roles)
            ->addColumn('action', 'admin.components.roles-button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function usersBig()
    {
        $users = User::all();
        return datatables()->of($users)
            ->addColumn('jabatan', function ($user) {
                return count($user->getRoleNames()) > 0 ? strtoupper(str_replace('_', ' ', $user->getRoleNames()[0])) : '';
            })
            ->addColumn('status', function ($user) {
                return $user->isOnline() ? 'Online' : 'Offline';
            })
            ->addColumn('action', 'admin.components.users-button-big')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function usersSmall()
    {
        $users = User::all();
        return datatables()->of($users)
            ->addColumn('status', function ($user) {
                return $user->isOnline() ? 'Online' : 'Offline';
            })
            ->addColumn('action', 'admin.components.users-button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }


    public function categories()
    {
        $categories = KategoriAsetKritis::all();
        return datatables()->of($categories)
            ->addColumn('action', 'operator.components.asset-categories-button')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function assets()
    {
        $assets = InformasiAsetKritis::select('id', 'id_kategori', 'name', 'deskripsi')->get();
        // dd($assets);
        return datatables()->of($assets)
            ->addColumn('kategori', function ($asset) {
                return $asset->kategoriAsetKritis->name;
            })
            ->addColumn('action', 'operator.components.assets-button')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function requirements()
    {
        $requirements = PersyaratanKeamanan::all();
        return datatables()->of($requirements)
            ->addColumn('aset', function ($requirement) {
                return $requirement->informasiAsetKritis->name;
            })
            ->addColumn('action', 'operator.components.requirements-button')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function analayzeRisks()
    {
        $risk = Risiko::all();
        return datatables()->of($risk)
            ->addColumn('aset', function ($risk) {
                return $risk->asetKritis->name;
            })
            ->addColumn('action', 'risk_owner.components.risks-button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function mitigationRisks()
    {
        $risk = Risiko::select('id', 'kode', 'ancaman', 'mitigation')->where('mitigation', '!=', null)->get();
        return datatables()->of($risk)
            ->addColumn('action', 'risk_owner.components.mitigate-risks-button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
