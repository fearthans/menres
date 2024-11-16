@extends('layouts.app-volt')

@section('styles')
    <style>
        .grid-background {
            background-image: url('img/grid.jpg');
            /* Replace with your grid image URL */
            background-size: cover;
            opacity: 0.1;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .header-message {
            position: fixed;
            z-index: 1;
            background-color: black;
            color: white;
            top: 0;
            left: 0;
            right: 0;
            padding: 10px;
            text-align: center;
        }
        .container {
            z-index: 1;
            position: relative;
        }
    </style>
@endsection

@section('content')
    <div class="grid-background"></div>
    <div class="d-relative w-100">
        <div class="header-message">
            Website ini dikembangkan dengan semangat 🔥
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-center w-100">
            <h1 class="text-center fs-1 fw-bold">Aplikasi Manajemen Risiko</h1>
            <p>Tim Penyusun</p>
            <ul>
              <li>Hanif</li>
              <li>Salasa</li>
              <li>Naza</li>
              <li>Dimas</li>
              <li>Nadya</li>
            </ul>
            @if (Auth::check())
                @if (Auth::user()->getRoleNames()[0] == 'admin')
                    <a href="{{ route('admin') }}" class="btn btn-danger consult-button">Beranda Admin</a>
                @elseif(Auth::user()->getRoleNames()[0] == 'risk_owner')
                    <a href="{{ route('risk.owner.dashboard') }}" class="btn btn-purple consult-button">Beranda <em>Risk Owner</em></a>
                @elseif(Auth::user()->getRoleNames()[0] == 'operator')
                    <a href="{{ route('operator.assets') }}" class="btn btn-info consult-button">Beranda Operator</a>
                @elseif(Auth::user()->getRoleNames()[0] == 'kepala_upt')
                    <a href="{{ route('kepala.upt.risk.profile') }}" class="btn btn-warning consult-button">Beranda Ketua UPT</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-gray-700">Masuk Ke Aplikasi</a>
            @endif
        </div>
    </div>
@endsection
