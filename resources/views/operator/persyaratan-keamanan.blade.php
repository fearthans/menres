@extends('layouts.dashboard-volt')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Tambahkan CSS Responsif DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <style>
        .table-description-head {
            overflow: hidden !important;
            white-space: nowrap;
        }

        .table-description {
            max-width: 150px;
            /* Adjust the width as needed */
            white-space: nowrap;
            overflow-x: scroll;
            /* text-overflow: ellipsis; */
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>Kelola Persyaratan Keamanan</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableAssets">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aset</th>
                                    <th>Jenis Prioritas Keamanan</th>
                                    <th class="table-description-head">Kebutuhan</th>
                                    <th>Aksi</th>
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

    <!-- Modal Edit-->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" aria-labelledby="editLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit Persyaratan keamananan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAssetForm" action="" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" class="form-control modal-id mb-3">
                        <input type="text" disabled name="aset" class="form-control modal-aset mb-3">
                        <!-- Modal content populated from button attribute -->
                        <label for="keamananEdit" class="form-label">Jenis Keamanan</label>
                        <select id="keamananEdit" name="jenis" class="form-select form-control mb-3"
                            aria-label="Kategori">
                            <option value="1">Kerahasiaan (Confidentiality)</option>
                            <option value="2">Integritas (Integrity)</option>
                            <option value="3">Ketersediaan Informasi (Availability)</option>
                        </select>
                        <label for="editKebutuhan" class="form-label">Kebutuhan</label>
                        <input type="text" id="editKebutuhan" class="form-control modal-kebutuhan mb-3" required
                            name="kebutuhan">
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
            $('#tableAssets').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('data.requirements') }}',
                    dataSrc: function(json) {
                        console.log(json); // Debugging JSON
                        return json.data; // Pastikan 'data' sesuai dengan struktur respons JSON
                    }
                },
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
                columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: true
                }, {
                    data: 'aset'
                }, {
                    data: 'jenis',
                    render: function(data, type, row) {
                        switch (data) {
                            case '1':
                                return '<span class="badge bg-danger">Kerahasiaan (Confidentiality)</span>';
                            case '2':
                                return '<span class="badge bg-secondary">Integritas (Integrity)</span>';
                            case '3':
                                return '<span class="badge bg-success">Ketersediaan (Availability)</span>';
                            default:
                                return '-';
                        }
                    }
                }, {
                    data: 'kebutuhan',
                    className: 'table-description'
                }, {
                    data: 'action'
                }]
            })
        })

        const modalElement = document.getElementById('editModal');
        modalElement.addEventListener('show.bs.modal', event => {

            // edit - jenis kemananan sekarang
            jenis = event.relatedTarget.getAttribute('data-bs-jenis');
            for (let option of modalElement.querySelector('#keamananEdit').options) {
                if (option.value === event.relatedTarget.getAttribute('data-bs-jenis')) {
                    option.selected = true; // Set this option as selected
                    break; // Exit the loop once found
                }
            }

            // Update the modal's content
            id = event.relatedTarget.getAttribute('data-bs-id');
            document.getElementById('editAssetForm').action = `{{ route('operator.security.requirements.edit', '') }}/${id}`;
            modalElement.querySelector('.modal-id').value = id;
            modalElement.querySelector('.modal-aset').value = event.relatedTarget.getAttribute('data-bs-aset');
            modalElement.querySelector('.modal-kebutuhan').value = event.relatedTarget.getAttribute('data-bs-kebutuhan');
        });
    </script>
@endpush
