<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
            <label for="nama_hewan" class="col-md-3 col-md-offset-1 control-label">Nama</label>
            <div class="col-md-8">
                <input type="text" name="nama_hewan" id="nama_hewan" class="form-control" required autofocus>
                <span class="help-block with-errors"></span>
            </div>
            <label for="deskripsi_hewan" class="col-md-3 col-md-offset-1 control-label">Deskripsi</label>
            <div class="col-md-8">
                <input type="text" name="deskripsi_hewan" id="deskripsi_hewan" class="form-control">
                <span class="help-block with-errors"></span>
            </div>
            <label for="image" class="col-md-3 col-md-offset-1 control-label">Gambar</label>
            <div class="col-md-8">
                <input type="file" name="image" id="image" class="form-control">
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