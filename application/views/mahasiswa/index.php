<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Mahasiswa</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Mahasiswa</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Mahasiswa</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('mahasiswa/tambah'); ?>"><i class="fa fa-plus"></i>Mahasiswa</a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Prodi</th>
              <th>Fakultas</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get('mahasiswa')->result() as $item) {
              ?>
              <tr>
                <td><?php echo $item->nim; ?></td>
                <td><?php echo $item->nama; ?></td>
                <td><?php echo $this->db->get_where('prodi', ['id' => $item->prodi_id])->row()->nama; ?></td>
                <td><?php echo $this->db->get_where('fakultas', ['id' => $this->db->get_where('prodi', ['id' => $item->prodi_id])->row()->fakultas_id])->row()->nama; ?></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('mahasiswa/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-primary" href="#" onclick="hapus('<?php echo $item->id; ?>')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                </div>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>