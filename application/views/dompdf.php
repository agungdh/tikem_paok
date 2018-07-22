<?php
// var_dump($form); die;
// var_dump($tabel); die;
?>
<center><h3>Data Kegiatan dan Prestasi Mahasiswa Universitas Budi Luhur</h3></center>
<br>

<?php
if (isset($form)) {
  foreach ($form as $key => $value) {
    switch ($key) {
      case 'tanggal_mulai':
        ?>
        <?php echo 'Tanggal Mulai' . ': ' . $value; ?>
        <br>
        <?php
        break;
      
      default:
        ?>
        <?php echo ucwords($key) . ': ' . $value; ?>
        <br>
        <?php   
        break;
    }
  }  
}
?>
<br>
<table border="1" id="table">
  <thead>
    <tr>
      <th>Kegiatan</th>
      <th>Tanggal Mulai</th>
      <th>Lokasi</th>
      <th>Kategori</th>
      <th>Tahun Ajar</th>
      <th>Semester</th>
      <th>Tingkat</th>
      <th>Pembina</th>
      <th>Keanggotaan</th>
      <th></th>
      <th>Prestasi</th>
      <th></th>
      <th>NIM</th>
      <th>Nama</th>
      <th>Prodi</th>
      <th>Fakultas</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($tabel as $item) {
      ?>
      <tr>
                <td><?php echo $item['kegiatan']; ?></td>
                <td><?php echo $item['tanggal_mulai']; ?></td>
                <td><?php echo $item['lokasi']; ?></td>
                <td><?php echo $item['kategori']; ?></td>
                <td><?php echo $item['tahun_ajar']; ?></td>
                <td><?php echo $item['semester']; ?></td>
                <td><?php echo $item['tingkat']; ?></td>
                <td><?php echo $item['pembina']; ?></td>
                <td><?php echo $item['keanggotaan']; ?></td>
                <?php
                if (file_exists('uploads/kegiatan/tim/' . $item['kegiatan_id'])) {
                  $foto = 'uploads/kegiatan/tim/' . $item['kegiatan_id'];
                } else {
                  $foto = 'assets/th.jpeg';
                }
                if (file_exists('uploads/kegiatan/individu/' . $item['kegiatan_id'])) {
                  $foto = 'uploads/kegiatan/individu/' . $item['kegiatan_id'];
                } else {
                  $foto = 'assets/th.jpeg';
                }
                ?>
                <td><img src="<?php echo $foto; ?>" width="200" height="150"></td>
                <td><?php echo $item['prestasi']; ?></td>
                <?php
                if (file_exists('uploads/prestasi/tim/' . $item['kegiatan_id'])) {
                  $foto = 'uploads/prestasi/tim/' . $item['kegiatan_id'];
                } else {
                  $foto = 'assets/th.jpeg';
                }
                if (file_exists('uploads/prestasi/individu/' . $item['kegiatan_id'])) {
                  $foto = 'uploads/prestasi/individu/' . $item['kegiatan_id'];
                } else {
                  $foto = 'assets/th.jpeg';
                }
                ?>
                <td><img src="<?php echo $foto; ?>" width="200" height="150"></td>
                <td><?php echo $item['nim']; ?></td>
                <td><?php echo $item['nama']; ?></td>
                <td><?php echo $item['prodi']; ?></td>
                <td><?php echo $item['fakultas']; ?></td>
              </tr>
      <?php
    }
    ?>
  </tbody>
</table>