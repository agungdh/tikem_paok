<?php
// var_dump($form); die;
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
      <th>Prestasi</th>
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
        <td><?php echo $item['prestasi']; ?></td>
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