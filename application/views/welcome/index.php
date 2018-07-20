<?php
$zenziva = simplexml_load_string(file_get_contents("https://reguler.zenziva.net/apps/smsapibalance.php?userkey=" . $data['config']->zenziva_userkey . "&passkey=" . $data['config']->zenziva_passkey));

$this->db->insert('log',
  [
    'tag' => 'Zenziva Cek Kredit',
    'base_url' => '',
    'time' => date('Y-m-d H:i:s'),
    'value' => json_encode($zenziva)
  ]);
?>

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
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
      <div class="info">
        <h4>Kredit SMS</h4>
        <p><b><?php echo isset($zenziva->message->value) ? $zenziva->message->value : $zenziva->message->text; ?></b></p>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-4">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-calendar-times-o fa-3x"></i>
      <div class="info">
        <h4>Jatuh Tempo</h4>
        <?php
        $jumlah_jatuh_tempo = 0;
        foreach ($this->db->get_where('peminjaman', ['status' => 1])->result() as $item) {
                    $deadline=date_create($item->tanggal);
                    date_add($deadline,date_interval_create_from_date_string($item->durasi . " days"));
                    $date1 = date("Y-m-d");
                    $date2 = date_format($deadline,"Y-m-d");
                    $days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);
                    if ($days <= 1) {
                      $jumlah_jatuh_tempo++;
                    }
        }
        ?>
        <p><b><?php echo $jumlah_jatuh_tempo; ?></b></p>
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
      <h3 class="tile-title">Grafik Peminjaman dan Pengembalian Handy Talky</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>