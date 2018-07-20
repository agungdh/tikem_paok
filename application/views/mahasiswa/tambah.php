<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Mahasiswa</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Mahasiswa</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Tambah Mahasiswa</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('mahasiswa/aksi_tambah'); ?>">
          
          <div class="form-group">
            <label class="control-label">NIM</label>
            <input class="form-control" type="text" required placeholder="Masukan NIM" name="data[nim]">
          </div>

          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" required placeholder="Masukan Nama" name="data[nama]">
          </div>

          <div class="form-group">
            <label class="control-label">Fakultas - Prodi</label>
            <select class="form-control select2" type="text" required name="data[prodi_id]">
              <?php
              foreach ($this->db->get('fakultas')->result() as $item_fakultas) {
                ?>
                <optgroup label="<?php echo $item_fakultas->nama; ?>">
                  <?php
                  foreach ($this->db->get_where('prodi', ['fakultas_id' => $item_fakultas->id])->result() as $item_prodi) {
                    ?>
                    <option value="<?php echo $item_prodi->id; ?>"><?php echo $item_prodi->nama; ?></option>
                    <?php
                  }
                  ?>
                </optgroup>
                <?php
              }
              ?>
            </select>
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('mahasiswa'); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>