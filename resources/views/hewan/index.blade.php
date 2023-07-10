@extends('layouts.master')

@section('title')
    Data Hewan
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header with-border">
                <button onclick="addForm('{{ route('hewan.store') }}')" class="btn btn-success btn-xs btn-flat"><i
                        class="fa fa-plus-circle"> Tambah </i></button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama Hewan</th>
                        <th>Deskripsi Hewan</th>
                        <th>Gambar Hewan</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('hewan.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('hewan.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false, sortable: false },
                { data: 'nama_hewan' },
                { data: 'deskripsi_hewan' },
                {
                    data: 'image',
                    render: function (data, type, row) {
                        return '<img src="{{ asset('storage/images') }}/' + data + '" class="img-thumbnail" width="100">';
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ]
        });

        $('#modal-form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                var url;

                if (save_method == "add") {
                    url = "{{ route('hewan.store') }}";
                } else {
                    url = "hewan/" + id;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData($('#modal-form form')[0]),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Tidak dapat menyimpan data');
                    }
                });
                return false;
            }
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Hewan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_hewan]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Hewan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_hewan]').focus();

        $.get(url)
                        .done(function (data) {
                $('#modal-form [name=nama_hewan]').val(data.nama_hewan);
                $('#modal-form [name=deskripsi_hewan]').val(data.deskripsi_hewan);
                // Tidak perlu mengisi nilai input file karena tidak bisa di-set secara langsung
                // $('#modal-form [name=image]').val(data.image);
            })
            .fail(function (xhr, status, error) {
                alert('Tidak dapat menampilkan data');
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data tersebut?')) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                },
                success: function (data) {
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    alert('Tidak dapat menghapus data');
                }
            });
        }
    }
</script>
@endpush
