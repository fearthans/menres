@extends('layouts.dashboard-volt')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Tambahkan CSS Responsif DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>Analisis Risiko</div>
                <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                    data-bs-target="#tambahModal">
                    <i class="fa-solid fa-plus"></i> Tambah Risiko Aset
                </button>
            </div>
            <div class="card-body">
                <table class="table" id="tableRisks">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Aset</th>
                            <th>Kode</th>
                            <th>Kerentanan</th>
                            <th>Ancaman</th>
                            <th>Pontential Cause</th>
                            <th>Pontential Effects</th>
                            <th>Severity</th>
                            <th>Occurrence</th>
                            <th>Detection</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="" method="post" id="deleteForm">
        @csrf
        @method('DELETE')
        <input type="submit" value="Hapus" style="display:none">
    </form>
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" aria-labelledby="tambahAnalisis">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAnalisis">Tambah Analisa Risiko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahAnalisisForm" action="{{ route('risk.owner.analyze.create') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <!-- Modal content populated from button attribute -->
                        <div class="d-flex gap-4 align-items-center mb-3">
                            <div class="w-25">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" id="kode" class="form-control" required readonly name="kode">
                            </div>
                            <div class="w-100">
                                <label for="aset" class="form-label">Aset</label>
                                <select id="aset" name="id_aset" class="form-select form-control"
                                    aria-label="Aset">
                                    @foreach ($datas['assets'] as $asset)
                                        <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label for="kerentanan" class="form-label">Kerentanan</label>
                        <input type="text" id="kerentanan" class="form-control mb-3" required name="kerentanan">
                        <label for="ancaman" class="form-label">Ancaman</label>
                        <input type="text" id="ancaman" class="form-control mb-3" required name="ancaman">
                        <label for="potensi_sebab" class="form-label">Potensi Sebab</label>
                        <input type="text" id="potensi_sebab" class="form-control mb-3" required name="potensi_sebab">
                        <label for="potensi_efek" class="form-label">Potensi Efek</label>
                        <input type="text" id="potensi_efek" class="form-control mb-3" required name="potensi_efek">
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <div>
                                <label for="severity" class="form-label mb-0">Severity</label>
                                <input type="number" max="8" id="severity" class="form-control" required name="severity"
                                    style="appearance: none;">
                            </div>
                            <div>
                                <label for="occurrence" class="form-label mb-0">occurrence</label>
                                <input type="number" max="8" id="occurrence" class="form-control" required name="occurrence"
                                    style="appearance: none;">
                            </div>
                            <div>
                                <label for="detection" class="form-label mb-0">Detection</label>
                                <input type="number" max="8" id="detection" class="form-control" required name="detection"
                                    style="appearance: none;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" aria-labelledby="editAnalisa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAnalisa">Edit Analisa Risiko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAnalisisForm" action="#" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="edit_id" class="form-control">
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <div class="w-25">
                                <label for="edit_kode" class="form-label mb-0">Kode</label>
                                <input type="text" id="edit_kode" class="form-control" required readonly name="kode">
                            </div>
                            <div class="w-100">
                                <label for="aset" class="form-label mb-0">Aset</label>
                                <select readonly id="edit_aset" name="id_aset" class="form-select form-control"
                                    aria-label="Asset">
                                    @foreach ($datas['assets'] as $asset)
                                        <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label for="edit_kerentanan" class="form-label">Kerentanan</label>
                        <input type="text" id="edit_kerentanan" class="form-control mb-3" required name="kerentanan">
                        <label for="edit_ancaman" class="form-label">Ancaman</label>
                        <input type="text" id="edit_ancaman" class="form-control mb-3" required name="ancaman">
                        <label for="edit_potensi_sebab" class="form-label">Potensi Sebab</label>
                        <input type="text" id="edit_potensi_sebab" class="form-control mb-3" required
                            name="potensi_sebab">
                        <label for="edit_potensi_efek" class="form-label">Potensi Efek</label>
                        <input type="text" id="edit_potensi_efek" class="form-control mb-3" required
                            name="potensi_efek">
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <div>
                                <label for="edit_severity" class="form-label mb-0">Severity</label>
                                <input type="number" id="edit_severity" class="form-control" required name="severity" max="8">
                            </div>
                            <div>
                                <label for="edit_occurrence" class="form-label mb-0">occurrence</label>
                                <input type="number" id="edit_occurrence" class="form-control" required name="occurrence" max="8">
                            </div>
                            <div>
                                <label for="edit_detection" class="form-label mb-0">Detection</label>
                                <input type="number" id="edit_detection" class="form-control" required name="detection" max="8">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Tambahkan JavaScript Responsif DataTables -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(function() {
            $('#tableRisks').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data.analyze-risks') }}',
                responsive: {
                    details: {
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                return col.hidden ?
                                    '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ? $('<table/>').append(data) : false;
                        }
                    }
                },
                columnDefs: [{
                    responsivePriority: 1,
                    targets: -1
                }], // Memberikan prioritas tinggi untuk kolom terakhir (Action)
                columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: true
                }, {
                    data: 'aset'
                }, {
                    data: 'kode'
                }, {
                    data: 'kerentanan',
                }, {
                    data: 'ancaman'
                }, {
                    data: 'potensi_sebab'
                }, {
                    data: 'potensi_efek'
                }, {
                    data: 'severity'
                }, {
                    data: 'occurrence'
                }, {
                    data: 'detection'
                }, {
                    data: 'action'
                }]
            })
        })

        const risikosByAssets = <?php echo json_encode($datas['risikos']); ?>;
        const assets = <?php echo json_encode($datas['assets']); ?>;

        console.log("risikosByAssets: ", risikosByAssets);
        console.log("risikosByAssets type: ", typeof risikosByAssets);
        const entri = Object.entries(risikosByAssets);
        console.log("risikosByAssets objentries: ", entri);
        console.log("risikosByAssets objentries type: ", typeof entri);

        for (const [key, value] of Object.entries(risikosByAssets)) {
            console.log(key, value);
        }

        console.log("assets: ", assets);
        // tambah modal - kode otomatis ambil nilai terbaru dari asset
        const selectedAsset = document.getElementById('aset');

        function updateKode() {
            const selectedOption = selectedAsset.value;
            document.getElementById('kode').value = setNewCode(selectedOption);
        }

        document.addEventListener('DOMContentLoaded', updateKode);
        selectedAsset.addEventListener('input', updateKode);

        function setNewCode(selectedOption) {
            let newCode = 1; // default jika belum ada kode baru
            // risikosByAssets.map(asset => {
            for (const [key, asset] of Object.entries(risikosByAssets)) {
                if (asset.id == selectedOption) {
                    // jika sudah ada di risk, ambil kode terakhir + 1 (cth: kode terakhir R1.3, maka 4)
                    lastCode = asset.risiko[asset.risiko.length - 1].kode.split('.')[1];
                    newCode = parseInt(lastCode) + 1;
                }
            }
            return `R${selectedOption}.${newCode}`;
        }

        const modalElementEdit = document.getElementById('editModal');
        modalElementEdit.addEventListener('show.bs.modal', event => {

            // data-bs-id="1" data-bs-asset="assetsss" data-bs-kode="kodesss" data-bs-kerentanan="rentannn" data-bs-ancaman="ancammm" 
            // data-bs-sebab="sebabbb" data-bs-efek="effekk" data-bs-severity="severrr" 
            // data-bs-occurrence="occurrr" data-bs-detection="detectionnn"

            // get id from button
            id = event.relatedTarget.getAttribute('data-bs-id');
            console.log("id edit analisis risiko: ", id);
            document.getElementById('editAnalisisForm').action =
                `{{ route('risk.owner.analyze.update', ['id' => ':id']) }}/`.replace(':id', id); // rawan error
            modalElementEdit.querySelector('#edit_id').value = id;

            // select the asset based on id
            const targetAsset = event.relatedTarget.getAttribute('data-bs-role');
            const selectAssets = modalElementEdit.querySelector('#edit_aset');
            for (let option of selectAssets.options) {
                // option value == id
                if (option.value === targetAsset) {
                    option.selected = true; // Set this option as selected
                    break; // Exit the loop once found
                }
            }
            console.log("kode: ", event.relatedTarget.getAttribute('data-bs-kode'));
            modalElementEdit.querySelector('#edit_kode').value = event.relatedTarget.getAttribute('data-bs-kode');
            modalElementEdit.querySelector('#edit_kerentanan').value = event.relatedTarget.getAttribute(
                'data-bs-kerentanan');
            modalElementEdit.querySelector('#edit_ancaman').value = event.relatedTarget.getAttribute(
                'data-bs-ancaman');
            console.log(event.relatedTarget.getAttribute('data-bs-sebab'));
            modalElementEdit.querySelector('#edit_potensi_sebab').value = event.relatedTarget.getAttribute(
                'data-bs-sebab');
            modalElementEdit.querySelector('#edit_potensi_efek').value = event.relatedTarget.getAttribute(
                'data-bs-efek');
            modalElementEdit.querySelector('#edit_severity').value = event.relatedTarget.getAttribute(
                'data-bs-severity');
            modalElementEdit.querySelector('#edit_occurrence').value = event.relatedTarget.getAttribute(
                'data-bs-occurrence');
            modalElementEdit.querySelector('#edit_detection').value = event.relatedTarget.getAttribute(
                'data-bs-detection');
        });
    </script>
@endpush
