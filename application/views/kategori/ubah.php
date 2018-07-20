<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Kategori</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Kategori</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Ubah Kategori</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('kategori/aksi_ubah'); ?>">

          <input type="hidden" name="where[id]" value="<?php echo $data['kategori']->id; ?>">

          <div class="form-group">
            <label class="control-label">Kategori</label>
            <input class="form-control" type="text" required placeholder="Masukan Kategori" name="data[kategori]" value="<?php echo $data['kategori']->kategori; ?>">
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('kategori'); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>