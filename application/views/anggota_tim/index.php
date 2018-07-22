<?php
$now = date('YmdHis');
?>
<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Anggota Tim</h1>
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
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Anggota Tim</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('anggota_tim/tambah/' . $data['detil_kegiatan']->id); ?>"><i class="fa fa-plus"></i>Anggota Tim</a></p>
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
            foreach ($this->db->get_where('detil_tim', ['tim_id' => $data['detil_kegiatan']->id])->result() as $item) {
              ?>
              <tr>
                <?php
                $mahasiswa = $this->db->get_where('mahasiswa', ['id' => $item->mahasiswa_id])->row();
                $prodi = $this->db->get_where('prodi', ['id' => $mahasiswa->prodi_id])->row();
                $fakultas = $this->db->get_where('fakultas', ['id' => $prodi->fakultas_id])->row();
                $tim = $this->db->get_where('tim', ['id' => $item->tim_id])->row();
                ?>
                <td><?php echo $mahasiswa->nim; ?></td>
                <td><?php echo $mahasiswa->nama; ?></td>
                <td><?php echo $prodi->nama; ?></td>
                <td><?php echo $fakultas->nama; ?></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('anggota_tim/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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