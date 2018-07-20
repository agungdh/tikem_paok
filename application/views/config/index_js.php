<script type="text/javascript" src="<?php echo base_url('assets/lib/smscount/smscount.min.js'); ?>"></script>

<script type="text/javascript">
$(function() {
    hitungSms();
});

$('.simpan').click(function(){
  $("input[type='submit']").click();
});

var sms = SMS();

$("#sms").keyup(function() {
	console.clear();
	hitungSms();
});

function hitungSms() {
	sms.count($("#sms").val(), function(totalCount, charsLeft, parts, limit) {
		$("#total").text(totalCount);
		var karakter = charsLeft;
		if (totalCount > 0 && charsLeft == 160) {
			karakter = 0;
		}
		$("#sisa").text(karakter);
	});
}
</script>