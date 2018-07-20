<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Peminjaman</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Peminjaman</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Tambah Peminjaman</h3>
      <div class="tile-body">
        <form method="post" action="<?php echo base_url('peminjaman/aksi_tambah'); ?>">

          <input type="hidden" name="data[user_id]" value="<?php echo $this->session->id; ?>">
          <input type="hidden" name="data[status]" value="1">
          
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" required placeholder="Masukan Nama" name="data[nama]">
          </div>

          <div class="form-group">
            <label class="control-label">NIP</label>
            <input class="form-control" type="text" required placeholder="Masukan NIP" name="data[nip]">
          </div>

          <div class="form-group">
            <label class="control-label">Nomor HP</label>
            <input class="form-control" type="text" required placeholder="Masukan Nomor HP" name="data[nohp]">
          </div>

          <div class="form-group">
            <label class="control-label">Nomor Seri</label>
            <input class="form-control" type="text" required placeholder="Masukan Nomor Seri" name="data[noseri]">
          </div>

          <div class="form-group">
            <label class="control-label">Jenis</label>
            <input class="form-control" type="text" required placeholder="Masukan Jenis" name="data[jenis]">
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal</label>
            <input class="form-control datepicker" type="text" required placeholder="Masukan Tanggal" name="data[tanggal]">
          </div>

          <div class="form-group">
            <label class="control-label">Durasi</label>
            <div class="input-group">
              <input class="form-control" type="number" min="1" required placeholder="Masukan Durasi" name="data[durasi]">
              <div class="input-group-append"><span class="input-group-text">Hari</span></div>
            </div>
          </div>

          </div>
          <div class="tile-footer">
            <button id="simpan" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="<?php echo base_url('peminjaman'); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a> <input type="submit" style="visibility: hidden;">
          </div>
        </form>
    </div>
  </div>
</div>