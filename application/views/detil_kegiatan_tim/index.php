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
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('detil_kegiatan_tim/tambah/' . $data['kegiatan']->id); ?>"><i class="fa fa-plus"></i><?php echo $data['kegiatan']->keanggotaan == 'i' ? 'Individu' : 'Tim' ?></a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>Tim</th>
              <th>Foto</th>
              <th>Prestasi</th>
              <th>Bukti</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get_where('tim', ['kegiatan_id' => $data['kegiatan']->id])->result() as $item) {
              ?>
              <tr>
                <td><?php echo $item->tim; ?></td>
                <?php
                if (file_exists('uploads/kegiatan/tim/' . $item->id)) {
                  $foto = 'uploads/kegiatan/tim/' . $item->id;
                } else {
                  $foto = 'assets/th.jpeg';
                }
                ?>
                <td><img height="150px" width="200px" src="<?php echo base_url($foto . '?time=' . $now); ?>"></td>
                <td><?php echo $item->prestasi; ?></td>
                <?php
                if (file_exists('uploads/prestasi/tim/' . $item->id)) {
                  $bukti = 'uploads/prestasi/tim/' . $item->id;
                } else {
                  $bukti = 'assets/th.jpeg';
                }
                ?>
                <td><img height="150px" width="200px" src="<?php echo base_url($bukti . '?time=' . $now); ?>"></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('anggota_tim/index/' . $item->id); ?>" data-toggle="tooltip" title="Anggota Tim"><i class="fa fa-share"></i></a>
                  <a class="btn btn-primary" href="<?php echo base_url('detil_kegiatan_tim/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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