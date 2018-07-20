<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Kegiatan</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Kegiatan</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Tambah Kegiatan</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('kegiatan/aksi_tambah'); ?>">
          
          <div class="form-group">
            <label class="control-label">Kegiatan</label>
            <input class="form-control" type="text" required placeholder="Masukan Kegiatan" name="data[kegiatan]">
          </div>

          <div class="form-group">
            <label class="control-label">Kategori</label>
            <select class="form-control select2" required name="data[kategori_id]">
              <?php
              foreach ($this->db->get('kategori')->result() as $item) {
                ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->kategori; ?></option>
                <?php
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Lokasi</label>
            <input class="form-control" type="text" required placeholder="Masukan Lokasi" name="data[lokasi]">
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal Mulai</label>
            <input class="form-control datepicker" type="text" required placeholder="Masukan Tanggal Mulai" name="data[tanggal_mulai]">
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal Selesai</label>
            <input class="form-control datepicker" type="text" required placeholder="Masukan Tanggal Selesai" name="data[tanggal_selesai]">
          </div>

          <div class="form-group">
            <label class="control-label">Tahun Ajar</label>
            <br>
            <input type="number" min="1900" max="2900" required placeholder="Masukan Tahun Ajar" name="data[tahun_ajar_awal]" id="ta1">
            /
            <input type="number" min="1900" max="2900" required placeholder="Masukan Tahun Ajar" name="data[tahun_ajar_akhir]" id="ta2">
          </div>

          <div class="form-group">
            <label class="control-label">Tingkat</label>
            <select class="form-control select2" required name="data[tingkat]">
              <option value="l">Lokal</option>
              <option value="n">Nasional</option>
              <option value="i">Internasional</option>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Semester</label>
            <select class="form-control select2" required name="data[semester]">
              <option value="o">Gasal</option>
              <option value="e">Genap</option>
            </select>
          </div>

           <div class="form-group">
            <label class="control-label">Pembina</label>
            <select class="form-control select2" required name="data[pembina_id]">
              <?php
              foreach ($this->db->get('pembina')->result() as $item) {
                ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->nip . ' ' . $item->nama; ?></option>
                <?php
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Keanggotaan</label>
            <select class="form-control select2" required name="data[keanggotaan]">
              <option value="t">Tim</option>
              <option value="i">Individu</option>
            </select>
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('kegiatan'); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>