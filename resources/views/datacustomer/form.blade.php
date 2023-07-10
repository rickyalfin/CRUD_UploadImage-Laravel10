<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
    <form action="" method="POST" class="form-horizontal">
        @csrf
        @method('post')

        <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <label for="nama" class="col-md-3 col-md-offset-1 control-label">Nama</label>
            <div class="col-md-8">
                <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                <span class="help-block with-errors"></span>
            </div>
            <label for="alamat" class="col-md-3 col-md-offset-1 control-label">Alamat</label>
            <div class="col-md-8">
                <input type="text" name="alamat" id="alamat" class="form-control">
                <span class="help-block with-errors"></span>
            </div>
            <label for="no_telp" class="col-md-3 col-md-offset-1 control-label">No Telpon</label>
            <div class="col-md-8">
                <input type="text" name="no_telp" id="no_telp" class="form-control">
                <span class="help-block with-errors"></span>
            </div>
            <label for="status" class="col-md-3 col-md-offset-1 control-label">Status</label>
            <div class="col-md-8">
                <input type="text" name="status" id="status" class="form-control">
                <span class="help-block with-errors"></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-sm btn-flat btn-primary">Simpan</button>
          <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
    </form>
  </div>
</div>