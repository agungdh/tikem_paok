<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Dashboard</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12 col-lg-4">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Jumlah Kegiatan</h4>
        <p><b><?php echo $this->db->query('SELECT count(id) jumlah FROM kegiatan')->row()->jumlah; ?></b></p>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-4">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-trophy fa-3x"></i>
      <div class="info">
        <h4>Jumlah Prestasi</h4>
        <?php
        $prestasi_individu = $this->db->query("SELECT count(id) jumlah
                                              FROM individu
                                              WHERE prestasi != ''")->row()->jumlah;

        $prestasi_tim = $this->db->query("SELECT count(id) jumlah
                                              FROM tim
                                              WHERE prestasi != ''")->row()->jumlah;

        $prestasi = $prestasi_individu + $prestasi_tim;
        ?>
        <p><b><?php echo $prestasi; ?></b></p>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-4">
    <div class="widget-small warning coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
      <div class="info">
        <h4>Tanggal</h4>
        <p><b><?php echo $this->pustaka->tanggal_indo_string(date('Y-m-d')); ?></b></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Grafik Kegiatan dan Prestasi</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>