<script type="text/javascript">
$(function() {
    $(".select2").select2();
});

$('#simpan').click(function(){
  $("input[type='submit']").click();
});

$('#form_ubah_password').submit(function() {
    if ($("#pw1").val() != $("#pw2").val()) {
      swal("Error !!!", "Password Tidak Sama !!!", "error");
      return false;
    } else {
      $("#form_ubah_password").submit();      
    }
});
</script>