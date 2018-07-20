<div class="app-title">
  <div>
    <h1><i class="fa fa-book"></i> Kategori</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Kategori</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="tile-title-w-btn">
          <h3 class="title">Data Kategori</h3>
          <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('kategori/tambah'); ?>"><i class="fa fa-plus"></i>Kategori</a></p>
        </div>
        <table class="table table-hover table-bordered datatable" >
          <thead>
            <tr>
              <th>Kategori</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($this->db->get('kategori')->result() as $item) {
              ?>
              <tr>
                <td><?php echo $item->kategori; ?></td>
                <td>
                  <div class="btn-group">
                  <a class="btn btn-primary" href="<?php echo base_url('kategori/ubah/' . $item->id); ?>" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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