<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Metode ini akan dipanggil setelah berhasil login
    protected function authenticated(Request $request)
    {
        // Mengarahkan pengguna berdasarkan role
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.roles'); // Halaman kelola role
        } elseif (Auth::user()->hasRole('risk_owner')) {
            return redirect()->route('risk.owner.dashboard'); // Halaman dashboard
        } elseif (Auth::user()->hasRole('operator')) {
            return redirect()->route('operator.asset.categories'); // Halaman kelola kategori aset
        } elseif (Auth::user()->hasRole('kepala_upt')) {
            return redirect()->route('kepala.upt.risk.profile'); // Halaman lihat profile risiko
        }

        // Default redirect jika tidak ada role yang sesuai
        return redirect('/');
    }
}
