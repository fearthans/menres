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
                        <div>Kelola Pengguna</div>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                            data-bs-target="#tambahModal">
                            <i class="fa-solid fa-plus"></i> Tambah Pengguna
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableUsers">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>Status</th>
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
        aria-hidden="true" aria-labelledby="tambahUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUser">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahUserForm" action="{{ route('admin.users.create') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <!-- Modal content populated from button attribute -->
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" id="name" class="form-control mb-3" required name="name">
                        <label for="role" class="form-label">Jabatan</label>
                        <select id="role" name="role" class="form-select form-control mb-3" aria-label="Jabatan">
                            <option selected value="0">User</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control mb-3" required name="email">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" id="pass" class="form-control mb-3" required name="password">
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
        aria-hidden="true" aria-labelledby="editUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUser">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" action="" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <!-- Modal content populated from button attribute -->
                        <input type="hidden" name="id" id="idEdit" class="form-control">
                        <label for="nameEdit" class="form-label">Nama</label>
                        <input type="text" id="nameEdit" class="form-control mb-3" required name="name">
                        <label for="roleEdit" class="form-label">Jabatan</label>
                        <select id="roleEdit" name="role" class="form-select form-control mb-3"
                            aria-label="Jabatan">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ strtoupper(str_replace('_', ' ',$role->name)) }}</option>
                            @endforeach
                            <option value="0">User</option>
                        </select>
                        <label for="emailEdit" class="form-label">Email</label>
                        <input type="email" id="emailEdit" class="form-control mb-3" required name="email">
                        <label for="passEdit" class="form-label">New Password <span class="text-muted">(optional)</span></label>
                        <input type="password" id="passEdit" class="form-control mb-3" name="password">
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
                $('#tableUsers').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data.user-small') }}',
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
                    }, {
                        data: 'jabatan'
                    }, {
                        data: 'email'
                    }, {
                        data: 'status'
                    }, {
                        data: 'action'
                    }]
                })
            })
        } else {
            $(function() {
                $('#tableUsers').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data.user-big') }}',
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
                    }, {
                        data: 'jabatan'
                    }, {
                        data: 'email'
                    }, {
                        data: 'status'
                    }, {
                        data: 'action'
                    }]
                })
            })
        }

        const modalElement = document.getElementById('editModal');
        modalElement.addEventListener('show.bs.modal', event => {
            // Update the modal's content
            id = event.relatedTarget.getAttribute('data-bs-id');
            console.log(id);
            document.getElementById('editUserForm').action = `{{ route('admin.users.edit', '') }}/${id}`;
            modalElement.querySelector('#idEdit').value = id;
            modalElement.querySelector('#nameEdit').value = event.relatedTarget.getAttribute('data-bs-name');

            // Get the role name from the button that triggered the modal
            const roleName = event.relatedTarget.getAttribute('data-bs-role');

            // Select the dropdown
            const roleSelect = modalElement.querySelector('#roleEdit');

            // Find the option with the matching text and set it as selected
            for (let option of roleSelect.options) {
                if (option.text === roleName.replace(/_/g, ' ').toUpperCase()) {
                    option.selected = true; // Set this option as selected
                    break; // Exit the loop once found
                } else if (option.text == 'User') {
                    option.selected = true; // Unselect other options
                }
            }

            modalElement.querySelector('#emailEdit').value = event.relatedTarget.getAttribute('data-bs-email');
        });
    </script>
@endpush
