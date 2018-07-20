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
      <h3 class="tile-title">Ubah Kegiatan</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('kegiatan/aksi_ubah'); ?>">
          
          <input type="hidden" name="where[id]" value="<?php echo $data['kegiatan']->id; ?>">

          <div class="form-group">
            <label class="control-label">Kegiatan</label>
            <input class="form-control" type="text" required placeholder="Masukan Kegiatan" name="data[kegiatan]" value="<?php echo $data['kegiatan']->kegiatan; ?>">
          </div>

          <div class="form-group">
            <label class="control-label">Kategori</label>
            <select class="form-control select2" required name="data[kategori_id]">
              <?php
              foreach ($this->db->get('kategori')->result() as $item) {
                if ($item->id == $data['kegiatan']->kategori_id) {
                  ?>
                  <option selected value="<?php echo $item->id; ?>"><?php echo $item->kategori; ?></option>
                  <?php
                } else {
                  ?>
                  <option value="<?php echo $item->id; ?>"><?php echo $item->kategori; ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Lokasi</label>
            <input class="form-control" type="text" required placeholder="Masukan Lokasi" name="data[lokasi]" value="<?php echo $data['kegiatan']->lokasi; ?>">
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal Mulai</label>
            <?php
            $tanggal_mulai = explode('-', $data['kegiatan']->tanggal_mulai);
            $tanggal_mulai = $tanggal_mulai[2] . '-' . $tanggal_mulai[1] . '-' . $tanggal_mulai[0];
            ?>
            <input class="form-control datepicker" type="text" required placeholder="Masukan Tanggal Mulai" name="data[tanggal_mulai]" value="<?php echo $tanggal_mulai; ?>">
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal Selesai</label>
            <?php
            $tanggal_selesai = explode('-', $data['kegiatan']->tanggal_selesai);
            $tanggal_selesai = $tanggal_selesai[2] . '-' . $tanggal_selesai[1] . '-' . $tanggal_selesai[0];
            ?>
            <input class="form-control datepicker" type="text" required placeholder="Masukan Tanggal Selesai" name="data[tanggal_selesai]" value="<?php echo $tanggal_selesai; ?>">
          </div>

          <div class="form-group">
            <label class="control-label">Tahun Ajar</label>
            <br>
            <?php
            $tahun_ajar = $data['kegiatan']->tahun_ajar;
            $tahun_ajar_awal = substr($tahun_ajar, 0, 4);
            $tahun_ajar_akhir = substr($tahun_ajar, 4, 4);
            ?>
            <input type="number" min="1900" max="2900" required placeholder="Masukan Tahun Ajar" name="data[tahun_ajar_awal]" id="ta1" value="<?php echo $tahun_ajar_awal; ?>">
            /
            <input type="number" min="1900" max="2900" required placeholder="Masukan Tahun Ajar" name="data[tahun_ajar_akhir]" id="ta2" value="<?php echo $tahun_ajar_akhir; ?>">
          </div>

          <div class="form-group">
            <label class="control-label">Tingkat</label>
            <select class="form-control select2" required name="data[tingkat]">
              <option <?php echo $data['kegiatan']->tingkat == 'l' ? 'selected' : null; ?> value="l">Lokal</option>
              <option <?php echo $data['kegiatan']->tingkat == 'n' ? 'selected' : null; ?> value="n">Nasional</option>
              <option <?php echo $data['kegiatan']->tingkat == 'i' ? 'selected' : null; ?> value="i">Internasional</option>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Semester</label>
            <select class="form-control select2" required name="data[semester]">
              <option <?php echo $data['kegiatan']->semester == 'o' ? 'selected' : null; ?> value="o">Gasal</option>
              <option <?php echo $data['kegiatan']->semester == 'e' ? 'selected' : null; ?> value="e">Genap</option>
            </select>
          </div>

           <div class="form-group">
            <label class="control-label">Pembina</label>
            <select class="form-control select2" required name="data[pembina_id]">
              <?php
              foreach ($this->db->get('pembina')->result() as $item) {
                if ($item->id == $data['kegiatan']->pembina_id) {
                  ?>
                  <option selected value="<?php echo $item->id; ?>"><?php echo $item->nip . ' ' . $item->nama; ?></option>
                  <?php
                } else {
                  ?>
                  <option value="<?php echo $item->id; ?>"><?php echo $item->nip . ' ' . $item->nama; ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Keanggotaan</label>
            <select class="form-control select2" required name="data[keanggotaan]">
              <option <?php echo $data['kegiatan']->keanggotaan == 't' ? 'selected' : null; ?> value="t">Tim</option>
              <option <?php echo $data['kegiatan']->keanggotaan == 'i' ? 'selected' : null; ?> value="i">Individu</option>
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