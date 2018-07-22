<?php
// var_dump($tabel);
// var_dump($form);
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
                <form method="post" action="<?php echo base_url(); ?>">
                  <div class="form-group">
                    <label class="control-label">Tanggal</label>
                    <input class="form-control" autocomplete="off" type="text" name="tanggal_mulai" id="daterangepicker" value="<?php echo isset($form['tanggal_mulai']) ? $form['tanggal_mulai'] : null; ?>">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Kategori</label>
                    <select class="form-control select2" name="kategori">
                      <?php
                      if ($this->input->post('kategori') != null) {
                        if ($this->input->post('kategori') == '0') {
                          $select = 'selected';
                        } else {
                          $select = null;
                        }
                      } else {
                        $select = null;
                      }
                      ?>
                      <option <?php echo $select; ?> value="0">Semua</option>
                      <?php
                      foreach ($this->db->get('kategori')->result() as $item) {
                        if ($this->input->post('kategori') != null) {
                          if ($this->input->post('kategori') == $item->id) {
                            $select = 'selected';
                          } else {
                            $select = null;
                          }
                        } else {
                          $select = null;
                        }
                        ?>
                        <option <?php echo $select; ?> value="<?php echo $item->id; ?>"><?php echo $item->kategori; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tingkat</label>
                    <select class="form-control select2" name="tingkat">
                      <option <?php echo $this->input->post('tingkat') != null && $this->input->post('tingkat') == '0' ? 'selected' : null; ?> value="0">Semua</option>
                      <option <?php echo $this->input->post('tingkat') != null && $this->input->post('tingkat') == 'l' ? 'selected' : null; ?> value="l">Lokal</option>
                      <option <?php echo $this->input->post('tingkat') != null && $this->input->post('tingkat') == 'n' ? 'selected' : null; ?> value="n">Nasional</option>
                      <option <?php echo $this->input->post('tingkat') != null && $this->input->post('tingkat') == 'i' ? 'selected' : null; ?> value="i">Internasional</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Keanggotaan</label>
                    <select class="form-control select2" name="keanggotaan">
                      <option <?php echo $this->input->post('keanggotaan') != null && $this->input->post('keanggotaan') == '0' ? 'selected' : null; ?> value="0">Semua</option>
                      <option <?php echo $this->input->post('keanggotaan') != null && $this->input->post('keanggotaan') == 't' ? 'selected' : null; ?> value="t">Tim</option>
                      <option <?php echo $this->input->post('keanggotaan') != null && $this->input->post('keanggotaan') == 'i' ? 'selected' : null; ?> value="i">Individu</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Prestasi</label>
                    <select class="form-control select2" name="prestasi">
                      <option <?php echo $this->input->post('prestasi') != null && $this->input->post('prestasi') == '0' ? 'selected' : null; ?> value="0">Semua</option>
                      <option <?php echo $this->input->post('prestasi') != null && $this->input->post('prestasi') == '1' ? 'selected' : null; ?> value="1">Hanya Berprestasi</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Fakultas</label>
                    <select class="form-control select2" name="fakultas" id="fakultas">
                      <option <?php echo $this->input->post('prestasi') != null && $this->input->post('prestasi') == '0' ? 'selected' : null; ?> value="0">Semua</option>
                      <?php
                      foreach ($this->db->get('fakultas')->result() as $item) {
                        ?>
                        <option <?php echo $this->input->post('fakultas') != null && $this->input->post('fakultas') == $item->id ? 'selected' : null; ?> value="<?php echo $item->id; ?>"><?php echo $item->nama; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Prodi</label>
                    <select class="form-control select2" name="prodi" id="prodi">
                      <option value="0">Semua</option>
                    </select>
                  </div>

                  <div class="tile-footer">
                    <button class="btn btn-primary filter" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Filter</button> <input type="submit" style="visibility: hidden;">
                  </div>
                </form>
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

              <br>

              <div class="tile-footer">
                <h3 class="tile-title">
                  Export
                  <button id="excel" class="btn btn-primary filter" type="button"><i class="fa fa-fw fa-lg fa-file-excel-o"></i>Excel</button>
                  <button id="pdf" class="btn btn-primary filter" type="button"><i class="fa fa-fw fa-lg fa-file-pdf-o"></i>PDF</button>
                </h3>
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
      $('.filter').click(function(){
        $("input[type='submit']").click();
      });
      
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
            
            <?php
            for ($i=0; $i <= 4; $i++) {
                  $array[] = $this->pustaka->tanggal_indo_string_bulan_tahun(date("m-Y", strtotime("-" . $i . " months")));
            }
            foreach (array_reverse($array) as $item) {
                  echo '"'.$item.'",';
             }
             unset($array);
            ?>
            ],
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
                        <?php
                        for ($i=0; $i <= 4; $i++) {
                              $bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
                              $tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];

                              $array[] = $this->db->query("
                                    SELECT count(*) total
                                    FROM kegiatan
                                    WHERE month(tanggal_mulai) = ?
                                    AND year(tanggal_mulai) = ?
                              ", [$bulan, $tahun])->row()->total;             
                        }
                        foreach (array_reverse($array) as $item) {
                              echo '"'.$item.'",';
                         }
                         unset($array);
                        ?>
                        ]
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
                        <?php
                        for ($i=0; $i <= 4; $i++) {
                              $bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
                              $tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];

                              $kegiatan = $this->db->query("
                                    SELECT *
                                    FROM kegiatan
                                    WHERE month(tanggal_mulai) = ?
                                    AND year(tanggal_mulai) = ?
                              ", [$bulan, $tahun])->result();

                              $total = 0;
                              foreach ($kegiatan as $item) {
                                 $total_individu = $this->db->query("SELECT count(id) jumlah
                                       FROM individu
                                       WHERE kegiatan_id = ?
                                       AND prestasi != ''", [$item->id])->row()->jumlah;

                                 $total_tim = $this->db->query("SELECT count(id) jumlah
                                       FROM tim
                                       WHERE kegiatan_id = ?
                                       AND prestasi != ''", [$item->id])->row()->jumlah;

                                 $total += $total_individu + $total_tim;                      
                              }
                              $array[] = $total;

                        }
                        foreach (array_reverse($array) as $item) {
                              echo '"'.$item.'",';
                         }
                         unset($array);
                        ?>
                        ]
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

    <script type="text/javascript">
      function ajax_prodi($prodi_id = null) {
        $.post("<?php echo base_url('welcome/ajax_prodi/'); ?>" + $prodi_id,
        {
            fakultas_id: $("#fakultas").val()
        },
        function(data, status){
            $("#prodi").html(data);
            $(".select2").select2();
        });  
      }

      ajax_prodi('<?php echo isset($form['prodi']) && $form['prodi'] != 0 ? $form['prodi'] : null ; ?>');

      $("#fakultas").change(function() {
        ajax_prodi();
      });

      $("#pdf").click(function() {
        window.location = "<?php echo base_url('welcome/export_pdf?'); ?>" + $("form").serialize();
      });

      $("#excel").click(function() {
        window.location = "<?php echo base_url('welcome/export_excel?'); ?>" + $("form").serialize();
      });
    </script>

  </body>

</html>