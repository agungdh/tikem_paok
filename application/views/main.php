<?php
// var_dump($tabel);
?>

<?php
$now = date('YmdHis');
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->db->get('config')->row()->judul_aplikasi; ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>assets/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <?php
    if (file_exists('uploads/favicon')) {
      $favicon = 'uploads/favicon';
    } else {
      $favicon = 'assets/favicon.png';
    }
    ?>
    <link rel="shortcut icon" href="<?php echo base_url($favicon) . '?time=' . $now; ?>"/>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"><?php echo $this->db->get('config')->row()->judul_aplikasi; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <?php
              if ($this->session->login == true) {
                $url = 'dashboard';
                $text = 'APP';
              } else {
                $url = 'login';
                $text = 'Login';
              }
              ?>
              <a class="navbar-brand" href="<?php echo base_url($url); ?>"><?php echo $text; ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <br><br><br>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="tile">
                
                  <div class="form-group">
                    <label class="control-label">Tanggal</label>
                    <input class="form-control" type="text" name="filter[tanggal_mulai]" id="daterangepicker">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Kategori</label>
                    <select class="form-control select2" name="filter[kategori]">
                      <option value="0">Semua</option>
                      <?php
                      foreach ($this->db->get('kategori')->result() as $item) {
                        ?>
                        <option value="<?php echo $item->id; ?>"><?php echo $item->kategori; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tingkat</label>
                    <select class="form-control select2" name="filter[tingkat]">
                      <option value="0">Semua</option>
                      <option value="l">Lokal</option>
                      <option value="n">Nasional</option>
                      <option value="i">Internasional</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Keanggotaan</label>
                    <select class="form-control select2" name="filter[keanggotaan]">
                      <option value="0">Semua</option>
                      <option value="t">Tim</option>
                      <option value="i">Individu</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Prestasi</label>
                    <select class="form-control select2" name="filter[prestasi]">
                      <option value="0">Semua</option>
                      <option value="1">Hanya Berprestasi</option>
                    </select>
                  </div>

                  <div class="tile-footer">
                    <button class="btn btn-primary simpan" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Filter</button>
                    &nbsp;&nbsp;&nbsp;
                  </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="tile">
              
              <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                  <h4>Jumlah Kegiatan</h4>
                  <p><b><?php echo $this->db->query('SELECT count(id) jumlah FROM kegiatan')->row()->jumlah; ?></b></p>
                </div>
              </div>

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

              <h3 class="tile-title">Grafik Kegiatan dan Prestasi</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
              </div>

            </div>  
          </div>
        </div>

        <table class="table" id="table">
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
      </div>
    </header>

        <script src="<?php echo base_url(''); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(''); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(''); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(''); ?>assets/js/main.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/jquery.vmap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/jquery.vmap.sampledata.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/jquery.vmap.world.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>daterangepicker/daterangepicker.js"></script>

    <script type="text/javascript">
      // $("#table").dataTable({
      //   "scrollX": true,
      //   "autoWidth": false,
      // });
      
      $(".select2").select2();
    </script>

    <script type="text/javascript">
      $('#daterangepicker').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear',
              format: 'DD-MM-YYYY'
          }
      });

      $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
      });

      $('#daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
    </script>

    <script type="text/javascript">
      var data = {
            labels: [
            
            "Maret 2018","April 2018","Mei 2018","Juni 2018","Juli 2018",            ],
            datasets: [
                  {
                        label: "Kegiatan",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                        "0","0","0","1","2",                        ]
                  },
                  {
                        label: "Prestasi",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [
                        "0","0","0","1","4",                        ]
                  }
            ]
      };
      var pdata = [
            {
                  value: 300,
                  color:"#F7464A",
                  highlight: "#FF5A5E",
                  label: "Red"
            },
            {
                  value: 50,
                  color: "#46BFBD",
                  highlight: "#5AD3D1",
                  label: "Green"
            },
            {
                  value: 100,
                  color: "#FDB45C",
                  highlight: "#FFC870",
                  label: "Yellow"
            }
      ]

var ctxl = $("#lineChartDemo").get(0).getContext("2d");
var lineChart = new Chart(ctxl).Line(data, {
   responsive : true,
   animation: true,
   barValueSpacing : 5,
   barDatasetSpacing : 1,
   tooltipFillColor: "rgba(0,0,0,0.8)",                
   multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
});
    </script>

  </body>

</html>