<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Fakultas</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Fakultas</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Fakultas</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('fakultas/tambah'); ?>"><i class="fa fa-plus"></i>Fakultas</a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>Fakultas</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get('fakultas')->result() as $item) {
              ?>
              <tr>
                <td><?php echo $item->nama; ?></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('prodi/index/' . $item->id); ?>" data-toggle="tooltip" title="Prodi"><i class="fa fa-share"></i></a>
                  <a class="btn btn-primary" href="<?php echo base_url('fakultas/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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