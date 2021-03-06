<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Fakultas</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item" style="cursor: pointer;" onclick="window.location = '<?php echo base_url('fakultas'); ?>'" data-toggle="tooltip" title="<?php echo $data['fakultas']->nama; ?>">Fakultas</li>
    <li class="breadcrumb-item">Prodi</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Ubah Fakultas</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('prodi/aksi_ubah'); ?>">
          
          <input type="hidden" name="where[id]" value="<?php echo $data['prodi']->id; ?>">
          <input type="hidden" name="data[fakultas_id]" value="<?php echo $data['fakultas']->id; ?>">

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" required placeholder="Masukan Nama" name="data[nama]" value="<?php echo $data['prodi']->nama; ?>">
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('prodi/index/' . $data['fakultas']->id); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>