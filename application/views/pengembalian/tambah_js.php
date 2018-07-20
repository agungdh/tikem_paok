<script type="text/javascript">
$('.datepicker').datepicker({
  format: "dd-mm-yyyy",
  autoclose: true,
  todayHighlight: true
});

$('#simpan').click(function(){
  $("input[type='submit']").click();
});

$('.select2').select2({
   minimumInputLength: 0,
   allowClear: true,
   placeholder: 'Masukan No Seri',
   ajax: {
      dataType: 'json',
      url: '<?php echo base_url('pengembalian/ajax_noseri'); ?>',
      delay: 300,
      data: function(params) {
        return {
          search: params.term
        }
      },
      processResults: function (data, page) {
      return {
        results: data
      };
    },
  }
});
</script>