<script type="text/javascript">
var table = $('#belum').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?php echo base_url('peminjaman/ajax_belum'); ?>",
        "type": "POST"
    },
    columnDefs: [
        { targets: [7,8,9], orderable: false}
    ],
    "scrollX": true,
    "autoWidth": false,
});

$('#sudah').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?php echo base_url('peminjaman/ajax_sudah'); ?>",
        "type": "POST"
    },
    "scrollX": true,
    "autoWidth": false,
});

function hapus(id) {
    swal({
        title: 'Apakah anda yakin?',
        text: "Data akan dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus!'
    }).then(function(result) {
        if (result.value) {
            $.get("<?php echo base_url('peminjaman/aksi_hapus/'); ?>" + id, function(data, status){
                table.ajax.reload();
            });
       }
    });
};
</script>