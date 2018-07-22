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