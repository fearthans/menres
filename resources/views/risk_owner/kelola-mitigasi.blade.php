@extends('layouts.dashboard-volt')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Tambahkan CSS Responsif DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>Mitigasi Risiko</div>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                            data-bs-target="#tambahModal">
                            <i class="fa-solid fa-plus"></i> Tambah Mitigasi Risiko
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tableDatas">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Ancaman</th>
                                    <th>Mitigasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post" id="deleteForm">
        @csrf
        @method('DELETE')
        <input type="submit" value="Hapus" style="display:none">
    </form>
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" aria-labelledby="tambahMitigasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMitigasi">Tambah Mitigasi Risiko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahMitigasiForm" action="{{ route('risk.owner.manage.create') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="tambah_id" class="form-control">
                        <!-- Modal content populated from button attribute -->
                        <label for="kode" class="form-label">Kode</label>
                        <select id="kode" name="kode" class="form-select form-control mb-3" aria-label="kode">
                            {{-- hanya kode yang mitigasi == null --}}
                            @foreach ($risikos as $risiko)
                                @if ($risiko->mitigation === null)
                                    <option value="{{ $risiko->kode }}">{{ $risiko->kode }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="mitigation" class="form-label">Mitigation</label>
                        <input type="text" id="mitigation" class="form-control mb-3" required name="mitigation">
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
        aria-hidden="true" aria-labelledby="editMitigasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMitigasi">Edit Mitigasi Risiko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editMitigasiForm" action="#" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="edit_id" class="form-control">
                        <!-- Modal content populated from button attribute -->
                        <label for="edit_kode" class="form-label">Kode</label>
                        <input type="text" id="edit_kode" class="form-control mb-3" required readonly name="kode">
                        <label for="edit_mitigation" class="form-label">Mitigation</label>
                        <input type="text" id="edit_mitigation" class="form-control mb-3" required name="mitigation">
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
            $('#tableDatas').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('data.mitigation-risks') }}',
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
                    data: 'kode'
                }, {
                    data: 'ancaman'
                }, {
                    data: 'mitigation'
                }, {
                    data: 'action'
                }]
            })
        })

        // data-bs-id="" data-bs-kode=""
        //   data-bs-mitigation="">
        const risikos = <?php echo json_encode($risikos); ?>;
        console.log("risikos: ", risikos);

        const modalElementEdit = document.getElementById('editModal');
        modalElementEdit.addEventListener('show.bs.modal', event => {

            // get id from button and set to form 
            // form tambah berlaku juga untuk form edit
            id = event.relatedTarget.getAttribute('data-bs-id');
            console.log("id edit manage mitigation: ", id);
            document.getElementById('editMitigasiForm').action =
                `{{ route('risk.owner.manage.update', ['id' => ':id']) }}/`.replace(':id', id); // rawan error
            modalElementEdit.querySelector('#edit_id').value = id;

            console.log("kode: ", event.relatedTarget.getAttribute('data-bs-kode'));
            modalElementEdit.querySelector('#edit_kode').value = event.relatedTarget.getAttribute('data-bs-kode');
            modalElementEdit.querySelector('#edit_mitigation').value = event.relatedTarget.getAttribute(
                'data-bs-mitigation');
        });
    </script>
@endpush
