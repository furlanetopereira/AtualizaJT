<?php	
if ($_POST['acao']!=''){
	$result = $Aplicacao->getAtualizacoes()->processa();
	if($result>0){
		$msg = 1;//sucesso
	}else{
		$msg = 0;//nao realizada
	}		
}
if ($_POST['delete']=='deposito'){
	$result = $Aplicacao->getAtualizacoes()->processaExcluirDeposito();
	if($result>0){
		$msg = 1;//sucesso
	}else{
		$msg = 0;//nao realizada
	}		
}
if ($_POST['delete']=='custa'){
	$result = $Aplicacao->getAtualizacoes()->processaExcluirCusta();
	if($result>0){
		$msg = 1;//sucesso
	}else{
		$msg = 0;//nao realizada
	}		
}


if($_SESSION['pesq']=='atualizacoes_tipo1' || $_POST['pesq']=='atualizacoes_tipo1'){

	if(isset($_POST[pesq])){
		$_SESSION['pesq'] = $_POST[pesq];
	}
	if(isset($_POST[pesq_id])){
		$_SESSION['pesq_id'] = $_POST[pesq_id];
	}
	if(isset($_POST[num_processo])){
		$_SESSION['num_processo'] = $_POST[num_processo];
	}
	$parametros['id'] = $_SESSION[pesq_id];
	$parametros['num_processo'] = $_SESSION[num_processo];
	$consulta = $Aplicacao->getAtualizacoes()->pegaAtualizacoes($parametros);
}
if($_POST['pesq']=='clear'){
	$_SESSION['pesq'] = "";
	$_SESSION['pesq_id'] = "";
	$_SESSION['num_processo'] = "";
}
?>