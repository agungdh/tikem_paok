<script type="text/javascript">
$(function() {
    $(".datatable").dataTable();
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
            window.location = "<?php echo base_url('fakultas/aksi_hapus/'); ?>" + id;
       }
    });
};
</script>