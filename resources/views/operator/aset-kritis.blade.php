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
                        <div>Kelola Aset Kritis</div>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                            data-bs-target="#tambahModal">
                            <i class="fa-solid fa-plus"></i> Tambah Aset Kritis
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableAssets">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th class="table-description-head">Deskripsi</th>
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
        aria-hidden="true" aria-labelledby="tambahAset">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAset">Tambah Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahAsetForm" action="{{ route('operator.assets.create') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <!-- Modal content populated from button attribute -->
                        <select name="id_kategori" class="form-select form-control mb-3" aria-label="Kategori">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" id="name" class="form-control mb-3" required name="name">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" id="deskripsi" class="form-control mb-3" required name="deskripsi">
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
        aria-hidden="true" aria-labelledby="editLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit Kategori Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAssetForm" action="" method="POST">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" class="form-control modal-id mb-3">
                        <!-- Modal content populated from button attribute -->
                        <select id="kategoriEdit" name="id_kategori" class="form-select form-control mb-3" aria-label="Kategori">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="editName" class="form-label">Nama</label>
                        <input type="text" id="editName" class="form-control modal-name mb-3" required name="name">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <input type="text" id="editDeskripsi" class="form-control modal-deskripsi mb-3" required name="deskripsi">
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
                    url: '{{ route('data.assets') }}',
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
                    data: 'kategori'
                }, {
                    data: 'name'
                }, {
                    data: 'deskripsi',
                    className: 'table-description'
                }, {
                    data: 'action'
                }]
            })
        })

        const modalElement = document.getElementById('editModal');
        modalElement.addEventListener('show.bs.modal', event => {
            // Get the role name from the button that triggered the modal
            const idCategori = event.relatedTarget.getAttribute('data-bs-kategori');

            // Select the dropdown
            const kategoriSelect = modalElement.querySelector('#kategoriEdit');

            // Find the option with the matching text and set it as selected
            for (let option of kategoriSelect.options) {
                if (option.value === idCategori) {
                    option.selected = true; // Set this option as selected
                    break; // Exit the loop once found
                } 
            }

            // Update the modal's content
            id = event.relatedTarget.getAttribute('data-bs-id');
            console.log(id);
            modalElement.querySelector('.modal-name').value = event.relatedTarget.getAttribute('data-bs-aset');
            modalElement.querySelector('.modal-deskripsi').value = event.relatedTarget.getAttribute('data-bs-deskripsi');
            document.getElementById('editAssetForm').action = `{{ route('operator.assets.edit', '') }}/${id}`;
            modalElement.querySelector('.modal-id').value = id;
        });
    </script>
@endpush
