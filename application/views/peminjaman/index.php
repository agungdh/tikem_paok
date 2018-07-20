<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Peminjaman</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Peminjaman</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Peminjaman Belum Dikembalikan</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('peminjaman/tambah'); ?>"><i class="fa fa-plus"></i>Peminjaman</a></p>
        </div>
        <table class="table table-hover table-bordered" id="belum" >
          <thead>
            <tr>
              <th>Nama</th>
              <th>NIP</th>
              <th>Nomor HP</th>
              <th>Nomor Seri</th>
              <th>Jenis</th>
              <th>Tanggal</th>
              <th>Durasi (Hari)</th>
              <th>Deadline</th>
              <th>Sisa Hari</th>
              <th>Proses</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

<div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Peminjaman Sudah Dikembalikan</h3>
        </div>
        <table class="table table-hover table-bordered" id="sudah">
          <thead>
            <tr>
              <th>Nama</th>
              <th>NIP</th>
              <th>Nomor HP</th>
              <th>Nomor Seri</th>
              <th>Jenis</th>
              <th>Tanggal</th>
              <th>Durasi (Hari)</th>
            </tr>
          </thead> 
        </table>
      </div>
    </div>
  </div>
</div>