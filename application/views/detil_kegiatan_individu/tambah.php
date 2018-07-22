<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Detil Kegiatan</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item" data-toggle="tooltip" title="<?php echo $data['kegiatan']->kegiatan; ?>">Kegiatan</li>
    <li class="breadcrumb-item">Detil Kegiatan</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Tambah Detil Kegiatan</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('detil_kegiatan_individu/aksi_tambah'); ?>" enctype="multipart/form-data">
          
          <input type="hidden" name="data[kegiatan_id]" value="<?php echo $data['kegiatan']->id; ?>">

          <div class="form-group">
            <label class="control-label">Mahasiswa</label>
            <select class="form-control select2" required name="data[mahasiswa_id]">
              <?php
              foreach ($this->db->query("SELECT *
                                          FROM mahasiswa
                                          WHERE id NOT IN (SELECT mahasiswa_id
                                                           FROM individu
                                                           WHERE kegiatan_id = ?)", [$data['kegiatan']->id])->result() as $item) {
                ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->nim . ' ' . $item->nama; ?></option>
                <?php
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Foto Kegiatan</label>
            <input class="form-control" type="file" name="foto_kegiatan">
          </div>

          <div class="form-group">
            <label class="control-label">Prestasi</label>
            <input class="form-control" type="text" placeholder="Masukan Prestasi" name="data[prestasi]">
          </div>

          <div class="form-group">
            <label class="control-label">Foto Prestasi</label>
            <input class="form-control" type="file" name="foto_prestasi">
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('detil_kegiatan_individu/index/' . $data['kegiatan']->id); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>