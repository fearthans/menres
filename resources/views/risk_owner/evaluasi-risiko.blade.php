@extends('layouts.dashboard-volt')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <style>
        .very-high {
            background-color: #E11D48 !important;
        }

        .high {
            background-color: #EF4683 !important;
        }

        .medium {
            background-color: #f3c78e !important;
        }

        .low {
            background-color: #63b1bd !important;
        }

        .very-low {
            background-color: #2361ce !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card border-0 shadow mb-4">
            <div class="card-header d-flex flex-row align-items-center flex-0 py-3 border-bottom">
                <h2 class="h6 text-gray-700 mb-0">Evaluasi Risiko</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="evaluate" style="width: 100%"
                        class="table table-striped table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">Kode</th>
                                <th class="border-0">Ancaman</th>
                                <th class="border-0">Pontential Cause</th>
                                <th class="border-0 rounded-end">RPN</th>
                                <th class="border-0 rounded-end">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($risikos as $risiko)
                                <tr>
                                    <td>{{ $risiko->id }}</td>
                                    <td>{{ $risiko->kode }}</td>
                                    <td class="overflow-scroll" style="max-width: 300px; overflow-y: hidden !important;">
                                        {{ $risiko->ancaman }}</td>
                                    <td class="overflow-scroll" style="max-width: 300px; overflow-y: hidden !important;">
                                        {{ $risiko->potensi_sebab }}</td>
                                    <td class="text-center fw-bold">{{ $risiko->rpn }}</td>
                                    <td class="text-center text-gray-100 fw-bold {{ str_replace(' ', '-', strtolower($risiko->kategori)) }}">
                                        {{ $risiko->kategori }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#evaluate').DataTable({
                responsive: true,
                paging: true,
                scrollX: true,
                ordering: true,
                info: true
            });
        });
        const tableCells = document.querySelectorAll('.overflow-scroll');
        for (const tableCell of tableCells) {
            if (tableCell && tableCell.scrollWidth <= tableCell.clientWidth+10) {
                console.log("perkecil scroll: ", tableCell.scrollWidth);
                console.log("perkecil width: ", tableCell.clientWidth);
                tableCell.classList.remove('overflow-scroll');
            }
        }
    </script>
@endpush
