<?php	
if ($_POST['nome']!='' && $_POST['senha']!=''){
	$result = $Aplicacao->Logar();
}
?>