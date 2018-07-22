<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Kegiatan</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Kegiatan</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Kegiatan</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('kegiatan/tambah'); ?>"><i class="fa fa-plus"></i>Kegiatan</a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>Kegiatan</th>
              <th>Tanggal</th>
              <th>Lokasi</th>
              <th>Kategori</th>
              <th>Tahun Ajar</th>
              <th>Tingkat</th>
              <th>Semester</th>
              <th>Pembina</th>
              <th>Keanggotaan</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get('kegiatan')->result() as $item) {
              ?>
              <tr>
                <td><?php echo $item->kegiatan; ?></td>
                <td><?php echo $this->pustaka->tanggal_indo_string($item->tanggal_mulai) . ' - ' . $this->pustaka->tanggal_indo_string($item->tanggal_selesai); ?></td>
                <td><?php echo $item->lokasi; ?></td>
                <td><?php echo $this->db->get_where('kategori', ['id' => $item->kategori_id])->row()->kategori; ?></td>
                <td><?php echo substr($item->tahun_ajar, 0, 4) . '/' . substr($item->tahun_ajar, 4, 4) ; ?></td>
                <?php
                if ($item->tingkat == 'l') {
                  $tingkat = "Lokal";
                } elseif ($item->tingkat == 'n') {
                  $tingkat = "Nasional";
                } else {
                  $tingkat = "Internasional";
                }
                ?>
                <td><?php echo $tingkat; ?></td>
                <?php
                if ($item->semester == 'o') {
                  $semester = "Gasal";
                } else {
                  $semester = "Genap";
                }
                ?>
                <td><?php echo $semester; ?></td>
                <?php 
                $pembina = $this->db->get_where('pembina', ['id' => $item->pembina_id])->row();
                ?>
                <td><?php echo $pembina->nip . ' ' . $pembina->nama; ?></td>
                <?php
                if ($item->keanggotaan == 'i') {
                  $keanggotaan = "Individu";
                  $url_keanggotaan = 'detil_kegiatan_individu';
                } else {
                  $keanggotaan = "Tim";
                  $url_keanggotaan = 'detil_kegiatan_tim';
                }
                ?>
                <td><?php echo $keanggotaan; ?></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url($url_keanggotaan . '/index/' . $item->id); ?>" data-toggle="tooltip" title="Detil Kegiatan"><i class="fa fa-share"></i></a>
                  <a class="btn btn-primary" href="<?php echo base_url('kegiatan/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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