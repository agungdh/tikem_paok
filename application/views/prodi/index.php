<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Prodi</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item" style="cursor: pointer;" onclick="window.location = '<?php echo base_url('fakultas'); ?>'" data-toggle="tooltip" title="<?php echo $data['fakultas']->nama; ?>">Fakultas</li>
    <li class="breadcrumb-item">Prodi</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Prodi</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('prodi/tambah/' . $data['fakultas']->id); ?>"><i class="fa fa-plus"></i>Prodi</a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>Prodi</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get_where('prodi', ['fakultas_id' => $data['fakultas']->id])->result() as $item) {
              ?>
              <tr>
                <td><?php echo $item->nama; ?></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('prodi/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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