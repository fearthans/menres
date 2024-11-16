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
                        <div>Kelola Jabatan</div>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                            data-bs-target="#tambahModal">
                            <i class="fa-solid fa-plus"></i> Tambah Jabatan
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableRoles">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
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

    <!-- Modal Tambah-->
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" aria-labelledby="tambahRole">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRole">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahRoleForm" action="{{ route('admin.roles.create') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <!-- Modal content populated from button attribute -->
                        <input type="text" class="form-control modal-name" required name="name">
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
        aria-hidden="true" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRoleForm" action="" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <!-- Modal content populated from button attribute -->
                        <input type="hidden" name="id" class="form-control modal-id mb-3">
                        <input type="text" class="form-control modal-name" required name="name">
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
        function getWindowWidth() {
            return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        }

        if (getWindowWidth() < 768) {
            // if (true) {
            $(function() {
                $('#tableRoles').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data.role-small') }}',
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
                            data: 'name'
                        },
                        {
                            data: 'action'
                        }
                    ]
                })
            })
        } else {
            $(function() {
                $('#tableRoles').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data.role-big') }}',
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
                            data: 'name'
                        },
                        {
                            data: 'action'
                        }
                    ]
                })
            })
        }

        const modalElement = document.getElementById('editModal');
        modalElement.addEventListener('show.bs.modal', event => {
            // Update the modal's content
            id = event.relatedTarget.getAttribute('data-bs-id');
            console.log(id);
            document.getElementById('editRoleForm').action = `{{ route('admin.roles.edit', '') }}/${id}`;
            modalElement.querySelector('.modal-id').value = id;
            modalElement.querySelector('.modal-name').value = event.relatedTarget.getAttribute('data-bs-name');
        });
    </script>
@endpush
