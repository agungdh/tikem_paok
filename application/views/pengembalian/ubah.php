<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Pengembalian</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Pengembalian</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Ubah Pengembalian</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('pengembalian/aksi_ubah'); ?>">

          <input type="hidden" name="where[id]" value="<?php echo $data['pengembalian']->id; ?>">
          <input type="hidden" name="data[user_id]" value="<?php echo $this->session->id; ?>">
          
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" value="<?php echo $data['pengembalian']->nama; ?>" type="text" required placeholder="Masukan Nama" name="data[nama]">
          </div>

          <div class="form-group">
            <label class="control-label">NIP</label>
            <input class="form-control" value="<?php echo $data['pengembalian']->nip; ?>" type="text" required placeholder="Masukan NIP" name="data[nip]">
          </div>

          <div class="form-group">
            <label class="control-label">No HP</label>
            <input class="form-control" value="<?php echo $data['pengembalian']->nohp; ?>" type="text" required placeholder="Masukan No HP" name="data[nohp]">
          </div>

          <div class="form-group">
            <label class="control-label">Nomor Seri</label>
            <input class="form-control" value="<?php echo $data['pengembalian']->noseri; ?>" type="text" required placeholder="Masukan No Seri" name="data[noseri]" readonly>
          </div>

          <?php
          $tanggal = date_format(date_create($data['pengembalian']->tanggal),"d-m-Y");
          ?>
          <div class="form-group">
            <label class="control-label">Tanggal</label>
            <input class="form-control datepicker" value="<?php echo $tanggal; ?>" type="text" required placeholder="Masukan Tanggal" name="data[tanggal]">
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('pengembalian'); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>