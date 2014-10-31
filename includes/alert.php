<?php 
$tipo_alert = 'alert-danger';

if(isset($msg)){ 
	if($msg==1) $tipo_alert = 'alert-info';

	echo '<div class="alert '.$tipo_alert.'" id="alert-mensagem">
		<button class="close" data-dismiss="alert">×</button>
		'.$Mensagens[$msg].'
		</div>';

} 
?>
<script>
$(document).ready(function() {
    setTimeout(function(){
        $('#alert-mensagem').fadeOut();
    }, 10000);
});
</script>