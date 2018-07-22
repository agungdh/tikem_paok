<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Anggota Tim</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item" style="cursor: pointer;" onclick="window.location = '<?php echo base_url('kegiatan'); ?>'" data-toggle="tooltip" title="<?php echo $data['kegiatan']->kegiatan; ?>">Kegiatan</li>
    <li class="breadcrumb-item" style="cursor: pointer;" onclick="window.location = '<?php echo base_url('detil_kegiatan_tim/index/' . $data['kegiatan']->id); ?>'" data-toggle="tooltip" title="<?php echo $data['detil_kegiatan']->tim; ?>">Detil Kegiatan</li>
    <li class="breadcrumb-item">Anggota Tim</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Tambah Anggota Tim</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('anggota_tim/aksi_tambah'); ?>" enctype="multipart/form-data">
          
          <input type="hidden" name="data[tim_id]" value="<?php echo $data['detil_kegiatan']->id; ?>">

          <div class="form-group">
            <label class="control-label">Mahasiswa</label>
            <select class="form-control select2" required name="data[mahasiswa_id]">
              <?php
              foreach ($this->db->query("SELECT *
                                        FROM mahasiswa
                                        WHERE id NOT IN (SELECT mahasiswa_id
                                                         FROM detil_tim
                                                         WHERE tim_id = ?)", [$data['detil_kegiatan']->id])->result() as $item) {
                ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->nim . ' ' . $item->nama; ?></option>
                <?php
              }
              ?>
            </select>
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('anggota_tim/index/' . $data['detil_kegiatan']->id); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>