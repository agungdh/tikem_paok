<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Pembina</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Pembina</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Ubah Pembina</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('pembina/aksi_ubah'); ?>">
          
          <input type="hidden" name="where[id]" value="<?php echo $data['pembina']->id; ?>">

          <div class="form-group">
            <label class="control-label">NIP</label>
            <input class="form-control" type="text" required placeholder="Masukan NIP" name="data[nip]" value="<?php echo $data['pembina']->nip; ?>">
          </div>

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" required placeholder="Masukan Nama" name="data[nama]" value="<?php echo $data['pembina']->nama; ?>">
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('pembina'); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>