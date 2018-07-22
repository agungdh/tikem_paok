<?php
$now = date('YmdHis');
?>
<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Detil Kegiatan</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item" style="cursor: pointer;" onclick="window.location = '<?php echo base_url('kegiatan'); ?>'" data-toggle="tooltip" title="<?php echo $data['kegiatan']->kegiatan; ?>">Kegiatan</li>
    <li class="breadcrumb-item">Detil Kegiatan</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Detil Kegiatan</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('detil_kegiatan_individu/tambah/' . $data['kegiatan']->id); ?>"><i class="fa fa-plus"></i><?php echo $data['kegiatan']->keanggotaan == 'i' ? 'Individu' : 'Tim' ?></a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Foto</th>
              <th>Prodi</th>
              <th>Fakultas</th>
              <th>Prestasi</th>
              <th>Bukti</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get_where('individu', ['kegiatan_id' => $data['kegiatan']->id])->result() as $item) {
              ?>
              <tr>
                <?php
                $mahasiswa = $this->db->get_where('mahasiswa', ['id' => $item->mahasiswa_id])->row();
                ?>
                <td><?php echo $mahasiswa->nim; ?></td>
                <td><?php echo $mahasiswa->nama; ?></td>
                <?php
                if (file_exists('uploads/kegiatan/individu/' . $item->id)) {
                  $foto = 'uploads/kegiatan/individu/' . $item->id;
                } else {
                  $foto = 'assets/th.jpeg';
                }
                ?>
                <td><img height="150px" width="200px" src="<?php echo base_url($foto . '?time=' . $now); ?>"></td>
                <td><?php echo $this->db->get_where('prodi', ['id' => $mahasiswa->prodi_id])->row()->nama; ?></td>
                <td><?php echo $this->db->get_where('fakultas', ['id' => $this->db->get_where('prodi', ['id' => $mahasiswa->prodi_id])->row()->fakultas_id])->row()->nama; ?></td>
                <td><?php echo $item->prestasi; ?></td>
                <?php
                if (file_exists('uploads/prestasi/individu/' . $item->id)) {
                  $bukti = 'uploads/prestasi/individu/' . $item->id;
                } else {
                  $bukti = 'assets/th.jpeg';
                }
                ?>
                <td><img height="150px" width="200px" src="<?php echo base_url($bukti . '?time=' . $now); ?>"></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('detil_kegiatan_individu/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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