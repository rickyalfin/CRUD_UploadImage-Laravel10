@extends('layouts.master')

@section('title')
    Data Customer
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header with-border">
          <button onclick="addForm('{{ route('datacustomer.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"> Tambah </i></button>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-stiped table-bordered">
            <thead>
              <th width="5%">No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No Telpon</th>
              <th>Status</th>
              <th width="15%"><i class="fa fa-cog"></i></th>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
  </div>
</div>

@includeIf('datacustomer.form')
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
            url : '{{ route('datacustomer.data') }}',
          },
          columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data:'nama'},
            {data:'alamat'},
            {data:'no_telp'},
            {data:'status'},
            {data:'aksi', searchable: false, sortable: false},
          ]
        });

      $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
          }
      });
    });

      function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Customer');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama]').focus();
      }

      function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Customer');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
          .done((response) => {
            $('#modal-form [name=nama]').val(response.nama);
            $('#modal-form [name=alamat]').val(response.alamat);
            $('#modal-form [name=no_telp]').val(response.no_telp);
            $('#modal-form [name=status]').val(response.status);
          })
          .fail((errors) => {
            alert('Tidak dapat menampilkan data');
            return;
          });
      }

      function deleteData(url) {
        if (confirm('Yakin ingin menghapus data tersebut?')) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
              })
              .done((response) => {
                table.ajax.reload();
              })
              .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
              });
        }
      }
    </script>
@endpush