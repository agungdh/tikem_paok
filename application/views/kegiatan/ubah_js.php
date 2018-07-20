<script type="text/javascript">
$(function() {
    $(".select2").select2();

    $('.datepicker').datepicker({
	  format: "dd-mm-yyyy",
	  autoclose: true,
	  todayHighlight: true
	});
});

$("#ta1").change(function() {
	$("#ta2").val(parseInt($("#ta1").val()) + 1);
});

$("#ta2").change(function() {
	$("#ta1").val(parseInt($("#ta2").val()) - 1);
});

$('#simpan').click(function(){
  $("input[type='submit']").click();
});
</script>