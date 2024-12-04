@extends('layouts.app-volt')

@section('styles')
    <style>
        /* Background grid styling */
        .grid-background {
            background-image: url('img/grid.jpg'); /* Replace with your grid image URL */
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Fixed header message styling */
        .header-message {
            position: fixed;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            top: 0;
            left: 0;
            right: 0;
            padding: 15px;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Content container styling */
        .container {
            z-index: 5;
            position: relative;
            padding: 3rem 1rem;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        /* Typography styles */
        h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #333;
        }

        p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 2rem;
        }

        .team-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        /* Button styles */
        .consult-button {
            font-size: 1.1rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 1rem 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .consult-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('content')
    <div class="grid-background"></div>
    <div class="d-relative w-100">
        <div class="header-message">
            Website ini dikembangkan dengan menggunakan framework Laravel dan menggunakan template Bootstrap
        </div>

        <div class="container">
            <h1>Aplikasi Manajemen Risiko</h1>
            <p>Tim Penyusun:</p>
            <div class="team-list">
                <div>Nazarudin</div>
                <div>Hanif Al Aslam</div>
                <div>Khalid Ibnu Walid</div>
                <div>Meri Cynthia Dewi</div>
                <div>Dimas Aqil Salsabil</div>
                <div>Nadya Amanda Putri Laniaz</div>
            </div>
            @if (Auth::check())
                @switch(Auth::user()->getRoleNames()[0])
                    @case('admin')
                        <a href="{{ route('admin') }}" class="btn btn-danger consult-button">Beranda Admin</a>
                        @break
                    @case('risk_owner')
                        <a href="{{ route('risk.owner.dashboard') }}" class="btn btn-purple consult-button">Beranda <em>Risk Owner</em></a>
                        @break
                    @case('operator')
                        <a href="{{ route('operator.assets') }}" class="btn btn-info consult-button">Beranda Operator</a>
                        @break
                    @case('kepala_upt')
                        <a href="{{ route('kepala.upt.risk.profile') }}" class="btn btn-warning consult-button">Beranda Ketua UPT</a>
                        @break
                @endswitch
            @else
                <a href="{{ route('login') }}" class="btn btn-gray-700 consult-button">Masuk Ke Aplikasi</a>
            @endif
        </div>
    </div>
@endsection
